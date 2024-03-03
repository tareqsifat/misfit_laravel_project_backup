<?php

namespace App\Http\Services\addon\saas;

use App\Models\Gateway;
use App\Models\Payment;
use App\Models\UserPackage;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class UserSubscriptionOrderService
{
    use ResponseTrait;

    public function getByStatus($request)
    {
        $status = 0;
        if ($request->status == 'Paid') {
            $status = PAYMENT_STATUS_PAID;
        } else if ($request->status == 'Pending') {
            $status = PAYMENT_STATUS_PENDING;
        }  else if ($request->status == 'Cancelled') {
            $status = PAYMENT_STATUS_CANCELLED;
        }

        $orders = Payment::query()
            ->leftJoin('users','payments.user_id','=','users.id')
            ->leftJoin('packages','payments.paymentable_id','=','packages.id')
            ->leftJoin('gateways', 'payments.gateway_id', '=', 'gateways.id')
            ->leftJoin('banks', 'payments.bank_id', '=', 'banks.id')
            ->whereNull('payments.tenant_id')
            ->where(function ($query) {
                $query->where('gateways.slug', '!=', 'bank')
                    ->whereIn('payments.payment_status', [STATUS_ACTIVE, STATUS_REJECT])
                    ->orWhere(function ($query) {
                        $query->where('gateways.slug', '=', 'bank');
                    });
            })->select([
                'users.name as userName',
                'users.email as userEmail',
                'packages.name as packagesName',
                'gateways.title as gatewayName',
                'gateways.slug as gatewaySlug',
                'banks.name as bankName',
                'payments.*'
            ]);

            if ($request->status == 'Pending') {
                $orders = $orders->where('gateways.slug','bank');
            }
            if ($request->status == 'All') {
                $orders = $orders;
            } else {
                $orders = $orders->where('payments.payment_status', $status);
            }

        return datatables($orders)
            ->addIndexColumn()
            ->addColumn('package', function ($order) {
                return '<h6>' . $order->packagesName . '</h6>';
            })
            ->addColumn('userName', function ($order) {

                return $order->userName;
            })
            ->addColumn('userEmail', function ($order) {
                return $order->userEmail;
            })
            ->addColumn('date', function ($order) {
                return $order->created_at->format('Y-m-d h:i');
            })
            ->addColumn('amount', function ($order) {
                return showPrice($order->sub_total);
            })
            ->addColumn('tnxId',function ($order){
                return $order->tnxId;
            })
            ->addColumn('gateway', function ($order) {
                return $order->gatewayName;
            })
            ->addColumn('payment_info', function ($order) {
                return '<div class="text-nowrap">' .
                    __('Bank Name').' : ' . $order->bankName . '<br>' .
                    __('Deposit Slip').' : '  . '<a href="'.(getFileUrl($order->deposit_slip)).'" target="_blank">' . __('View slip') . '</a>'.
                    '</div>';
            })

            ->addColumn('status', function ($order) {
                if ($order->payment_status == PAYMENT_STATUS_PAID) {
                    return '<div class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-0fa958 bg-0fa958-10">'.__('Paid').'</div>';
                } elseif ($order->payment_status == PAYMENT_STATUS_PENDING) {
                    return '<div class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-f5b40a bg-f5b40a-10">'.__('Pending').'</div>';
                } else {
                    return '<div class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-ea4335 bg-ea4335-10">'.__('Cancelled').'</div>';
                }
            })
            ->addColumn('action', function ($data) {
                $html = '<div class="d-flex justify-content-center align-items-center g-10">';
                    $html .= "<button type='button' class='border-0 p-0 bg-transparent flex-shrink-0 me-2 orderPayStatus' title='Status' data-id='$data->id'><img src='" . asset('assets/images/icon/edit.svg') . "'></button>";
                return $html;

            })
            ->rawColumns(['package', 'userName', 'status', 'gateway', 'action','payment_info'])
            ->make(true);
    }

    public function orderGetInfo($id)
    {
        try {
            return Payment::query()
                ->join('gateways', 'payments.gateway_id', '=', 'gateways.id')
                ->select(['payments.*', 'gateways.title as gatewayTitle'])
                ->where('payments.id', $id)
                ->first();
        } catch (Exception $e) {
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([],  $message);
        }
    }

    public function orderPaymentStatusChange($request)
    {
        DB::beginTransaction();
        try {
            $order=Payment::findOrFail($request->id);

            $order->update([
                'payment_status' => $request->payment_status
            ]);

            if($request->payment_status == PAYMENT_STATUS_PAID) {
                $gateway = Gateway::find($order->gateway_id);
                $order->payment_time = now();
                $order->gateway_callback_details = json_encode($request->all());
                $order->save();

                UserPackage::where('tenant_id', $order->user->tenant_id)->where('user_id', $order->user_id)->where('end_date', '>=', now())->update(['status' => PAYMENT_STATUS_CANCELLED]);

                $expiredDate = $order->subscription_type == SUBSCRIPTION_TYPE_MONTHLY ? now()->addMonth() : now()->addYear();

                $reference = $order->paymentable->userPackage()->create([
                    'user_id' => $order->user_id,
                    'tenant_id' => $order->user->tenant_id,
                    'package_id' => $order->paymentable_id,
                    'payment_id' => $order->id,
                    'start_date' => now(),
                    'end_date' => $expiredDate,
                    'subscription_type' => $order->subscription_type,
                    'status' => STATUS_ACTIVE,
                ]);

                $purpose = __('Subscription payment for ') . $order->paymentable->name;
                $type = TRANSACTION_SUBSCRIPTION;

                $link = route('admin.subscription.index');
                genericEmailNotify('', $order->user, NULL, 'subscription-approval', $link);

                //Create Transaction
                $order->transaction()->create([
                    'tenant_id' => NULL,
                    'user_id' => $order->user_id,
                    'reference_id' => $reference->id,
                    'type' => $type,
                    'tnxId' => $order->tnxId,
                    'amount' => $order->grand_total,
                    'purpose' => $purpose,
                    'payment_time' => $order->payment_time,
                    'payment_method' => $gateway->title
                ]);

                setCommonNotification(__('Payment'), $purpose, route('admin.subscription.index'), $order->user_id);
                $customData = [
                    'transaction_no' => $order->tnxId,
                ];
                $link = route('admin.subscription.transaction.list');
                genericEmailNotify('', $order->user, $customData, 'subscription-payment-success', $link);
                //Email Payment Successful
            }

            DB::commit();
            $message = __("Payment Status Changed Successfully.");
            return $this->success([], $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }
}
