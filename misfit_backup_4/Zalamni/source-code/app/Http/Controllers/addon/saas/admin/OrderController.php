<?php

namespace App\Http\Controllers\addon\saas\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Services\GatewayService;
use App\Http\Services\Payment\Payment;
use App\Models\Bank;
use App\Models\Currency;
use App\Models\FileManager;
use App\Models\Gateway;
use App\Models\GatewayCurrency;
use App\Models\Package;
use App\Models\Payment as ModelsPayment;
use App\Models\User;
use App\Models\UserPackage;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use ResponseTrait;

    public function checkout(Request $request)
    {
        $tenantId = NULL;
        if(!is_null($request->slug) && !is_null($request->type)){
            $package = Package::where('slug', $request->slug)->first();
            if(is_null($package)){
                return redirect(route('index'))->with(['error' => __('No Package Found')]);
            }
            $data['package'] = $package;
            $data['price'] = $request->type == SUBSCRIPTION_TYPE_MONTHLY ? $package->monthly_price : $package->yearly_price;
            $data['type'] = $request->type;
            $data['slug'] = $package->slug;
            $data['id'] = $package->id;
            if($data['price'] < 1 || $package->is_trail){
                UserPackage::where('tenant_id', getTenantId())->where('user_id', auth()->id())->where('end_date', '>=', now())->update(['status' => STATUS_REJECT]);

                $expiredDate = $request->type == SUBSCRIPTION_TYPE_MONTHLY ? now()->addMonth() : now()->addYear();

                UserPackage::create([
                    'user_id' => auth()->id(),
                    'tenant_id' => auth()->user()->tenant_id,
                    'package_id' => $package->id,
                    'start_date' => now(),
                    'end_date' => $expiredDate,
                    'subscription_type' => $request->type,
                    'status' => STATUS_ACTIVE,
                ]);

                return back()->with(['success' => __('Free plan subscribed successfully')]);
            }
            $data['gateways'] = Gateway::where('tenant_id', $tenantId)->where('status', ACTIVE)->get();
            $data['banks'] = Bank::where('tenant_id', $tenantId)->where('status', ACTIVE)->get();
        }else{
            return redirect(route('index'))->with(['error' => __('Data Not Found')]);
        }

        return view('addon.saas.admin.subscription.checkout', $data);
    }

    public function pay(OrderRequest $request)
    {
        $gateway = Gateway::where('tenant_id', NULL)->where(['slug' => $request->gateway, 'status' => ACTIVE])->first();
        if(is_null($gateway)){
            return back()->with(['error' => __('Gateway Not Found')]);
        }
        $gatewayCurrency = GatewayCurrency::where(['gateway_id' => $gateway->id, 'currency' => $request->currency])->first();
        if(is_null($gatewayCurrency)){
            return back()->with(['error' => __('Gateway Currency Not Found')]);
        }

        $object = Package::where('id', $request->id)->first();
        $userPackage = userCurrentPackage(getTenantId());
        $price = $request->type == SUBSCRIPTION_TYPE_MONTHLY ? $object->monthly_price : $object->yearly_price;
        $subscriptionType = $request->type;
        $purpose = __('Subscription order place successfully');

        if(!is_null($object) && !is_null($userPackage) && $userPackage->package_id == $object->id){
            return back()->with(['error' => __('You are already in this plan')]);
        }

        if(!isset($object) || is_null($object)){
            return back()->with(['error' => __('Desire payment data not found')]);
        }

        if(is_null($gatewayCurrency)){
            return back()->with(['error' => __('Gateway Currency Not Found')]);
        }

        if ($gateway->slug == 'bank') {
            DB::beginTransaction();
            try {
                $bank = Bank::where('tenant_id', NULL)->where(['gateway_id' => $gateway->id, 'id' => $request->bank_id])->firstOrFail();
                $bank_id = $bank->id;
                $deposit_slip_id = null;
                if ($request->hasFile('bank_slip')) {
                    $new_file = new FileManager();
                    $uploaded = $new_file->upload('payments', $request->bank_slip);
                    $deposit_slip_id = $uploaded->id;
                }

                $order = $this->placeOrder($object, $price, $gateway, $gatewayCurrency, $subscriptionType, $bank_id, $deposit_slip_id); // new order create

                //super admin
                $superAdmin = User::where('role', USER_ROLE_SUPER_ADMIN)->first();
                setCommonNotification( __('Order Place'), $purpose, Null, $superAdmin->id);
                setCommonNotification( __('Order Place'), $purpose, Null, $order->user_id);
                $link = route('admin.subscription.index');
                genericEmailNotify('', $order->user ,NULL,'subscription-order',$link);

                DB::commit();
                return redirect()->route('admin.subscription.checkout.success', ['success' => true, 'message' =>  __('Bank Details Sent Successfully! Wait for approval')]);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('admin.subscription.checkout.success', ['success' => false, 'message' => __('Your payment has been failed!')]);
            }
        } else {
            $order = $this->placeOrder($object, $price, $gateway, $gatewayCurrency, $subscriptionType); // new order create

            //super admin
            $superAdmin = User::where('role', USER_ROLE_SUPER_ADMIN)->first();
            setCommonNotification( __('Order Place'), $purpose, Null, $superAdmin->id);
            setCommonNotification( __('Order Place'), $purpose, Null, $order->user_id);
            $link = route('admin.subscription.index');
            genericEmailNotify('', $order->user ,NULL,'subscription-order',$link);

        }


        $object = [
            'id' => $order->id,
            'callback_url' => route('subscription.payment.verify'),
            'currency' => $gatewayCurrency->currency,
            'tenant_id' => $order->tenant_id,
        ];

        $payment = new Payment($gateway->slug, $object);
        $responseData = $payment->makePayment($order->grand_total);
        if ($responseData['success']) {
            $order->paymentId = $responseData['payment_id'];
            $order->save();
            return redirect($responseData['redirect_url']);
        } else {
            return redirect()->back()->with('error', $responseData['message']);
        }
    }

    public function placeOrder($object, $price, $gateway, $gatewayCurrency, $subscriptionType, $bank_id = null, $deposit_slip_id = null)
    {
        return $object->payments()->create([
            'user_id' => auth()->id(),
            'tenant_id' => NULL,
            'tnxId' => uniqid(),
            'system_currency' => Currency::where('current_currency', 'on')->first()->currency_code,
            'gateway_id' => $gateway->id,
            'payment_currency' => $gatewayCurrency->currency,
            'conversion_rate' => $gatewayCurrency->conversion_rate,
            'sub_total' => $price,
            'grand_total' => $price,
            'subscription_type' => $subscriptionType,
            'grand_total_with_conversation_rate' => $price * $gatewayCurrency->conversion_rate,
            'bank_id' => $bank_id,
            'deposit_slip' => $deposit_slip_id,
            'payment_details' => json_encode($object),
            'payment_status' => PAYMENT_STATUS_PENDING
        ]);
    }

    public function verify(Request $request)
    {
        $order_id = $request->get('id', '');
        $payerId = $request->get('PayerID', NULL);
        $payment_id = $request->get('payment_id', NULL);

        $order = ModelsPayment::find($order_id);
        if(is_null($order)){
            return redirect()->route('admin.subscription.checkout.success', ['success' => false, 'message' => __('Your order is not exist!')]);
        }

        if ($order->payment_status == PAYMENT_STATUS_PAID) {
            return redirect()->route('admin.subscription.checkout.success', ['success' => false, 'message' => __('Your order is not exist!')]);
        }

        $gateway = Gateway::find($order->gateway_id);
        DB::beginTransaction();
        try {
            if ($order->gateway_id == $gateway->id && $gateway->slug == MERCADOPAGO) {
                $order->paymentId = $payment_id;
                $order->save();
            }

            $payment_id = $order->paymentId;

            $gatewayBasePayment = new Payment($gateway->slug, ['currency' => $order->payment_currency, $order->tenant_id]);
            $payment_data = $gatewayBasePayment->paymentConfirmation($payment_id, $payerId);

            if ($payment_data['success']) {
                if ($payment_data['data']['payment_status'] == 'success') {
                    $order->payment_status = PAYMENT_STATUS_PAID;
                    $order->payment_time = now();
                    $order->gateway_callback_details = json_encode($request->all());
                    $order->save();

                    UserPackage::where('tenant_id', $order->user->tenant_id)->where('user_id', $order->user_id)->where('end_date', '>=', now())->update(['status' => STATUS_REJECT]);

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

                    $purpose = __('Subscription payment for ').  $order->paymentable->name;
                    $type = TRANSACTION_SUBSCRIPTION;

                    $link = route('admin.subscription.index');
                    genericEmailNotify('',$order->user,NULL,'subscription-approval',$link);

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

                    //super admin
                    $superAdmin = User::where('role', USER_ROLE_SUPER_ADMIN)->first();
                    setCommonNotification( __('Payment'), $purpose, NULL, $superAdmin->id);
                    setCommonNotification( __('Payment'), $purpose, route('admin.subscription.index'), $order->user_id);
                    $customData = [
                        'transaction_no'=> $order->tnxId,
                    ];
                    $link = route('admin.subscription.transaction.list');
                    genericEmailNotify('',$order->user,$customData,'subscription-payment-success',$link);
                    //Email Payment Successful

                    DB::commit();
                    return redirect()->route('admin.subscription.checkout.success', ['success' => true, 'message' =>  __('Your payment has been successful!')]);
                }
            } else {
                return redirect()->route('admin.subscription.checkout.success', ['success' => false, 'message' => __('Your payment has been failed')]);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('admin.subscription.checkout.success', ['success' => false, 'message' => __('Your payment has been failed')]);
        }
    }

    public function getCurrencyByGateway(Request $request)
    {
        $gateWayService = new GatewayService;
        $data = $gateWayService->getCurrencyByGatewayId($request->id);
        return $this->success($data);
    }

    public function checkoutSuccess(Request $request){
        $data['success'] = $request->success;
        $data['message'] = $request->message;
        return view('addon.saas.admin.subscription.checkout-success', $data);
    }

}
