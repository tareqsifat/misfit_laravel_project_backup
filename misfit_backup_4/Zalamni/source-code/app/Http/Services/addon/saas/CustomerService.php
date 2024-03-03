<?php

namespace App\Http\Services\addon\saas;

use App\Models\CustomDomainRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerService
{
    use ResponseTrait;

    public function customerList()
    {
        $customer = User::leftJoin('domains', 'users.tenant_id', '=', 'domains.tenant_id')
            ->leftJoin('user_packages', function($join) {
                $join->on('users.id', '=', 'user_packages.user_id')->where('user_packages.status', ACTIVE)->where('user_packages.end_date', '>=', now());
            })
            ->leftJoin('packages', 'packages.id', '=', 'user_packages.package_id')
            ->select(
                'domains.domain as customer_domain',
                'users.name as customer_name',
                'users.email as customer_email',
                'users.status as customer_status',
                'users.created_at as customer_create_date',
                'users.id as customer_id',
                'packages.name as package_name',
            )
            ->where('users.role', USER_ROLE_ADMIN);

        return datatables($customer)
            ->addIndexColumn()
            ->addColumn('customer_domain', function ($data) {
                return $data->customer_domain;
            })
            ->addColumn('name', function ($data) {
                return '<div class="text-nowrap">' . $data->customer_name . '</div>';
            })
            ->addColumn('email', function ($data) {
                return $data->customer_email;
            })
            ->addColumn('date', function ($data) {
                if($data->customer_create_date){
                    return '<div class="text-nowrap">' .\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->customer_create_date)->format('jS F, h:i:s A'). '</div>';
                }
                return $data->customer_create_date;
            })
            ->addColumn('current_plan', function ($data) {
                return $data->package_name;
            })
            ->addColumn('status', function ($data) {
                if ($data->customer_status == STATUS_ACTIVE) {
                    return '<span class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-0fa958 bg-0fa958-10">'.__("Active").'</span>';
                } else {
                    return '<span class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-ea4335 bg-ea4335-10">'.__("Deactivate").'</span>';
                }
            })
            ->addColumn('action', function ($data){
                return '<ul class="d-flex align-items-center cg-5 justify-content-center">
                            <li class="d-flex gap-2">
                                <button onclick="getEditModal(\'' . route('saas.super_admin.customer_edit', $data->customer_id) . '\'' . ', \'#edit-modal\')" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" data-bs-toggle="modal" data-bs-target="#alumniPhoneNo" title="'.__('Edit').'">
                                    <img src="' . asset('assets/images/icon/edit.svg') . '" alt="edit" />
                                </button>
                                <button onclick="deleteItem(\'' . route('saas.super_admin.customer_delete', $data->customer_id) . '\', \'customersTable\')" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" title="'.__('Delete').'">
                                    <img src="' . asset('assets/images/icon/delete-1.svg') . '" alt="delete">
                                </button>
                                <a href="'. route('saas.super_admin.customer_details', $data->customer_id) .'" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" title="View">
                                    <img src="' . asset('assets/images/icon/eye.svg') . '" alt="view">
                                </a>
                            </li>
                        </ul>';
            })
            ->rawColumns(['action', 'current_plan', 'date', 'status', 'email', 'name', 'plan_status', 'customer_domain'])
            ->make(true);
    }

    public function deleteById($id)
    {
        try {
            DB::beginTransaction();
            $user = User::where('id', $id)->firstOrFail();
            $user->delete();
            DB::commit();
            $message = getMessage(DELETED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::where('id', $id)->firstOrFail();
            $user->email = $request->email;
            $user->name = $request->name;
            $user->status = $request->status;
            $user->save();
            DB::commit();
            $message = getMessage(UPDATED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

    public function getById($id)
    {
        return User::where('id', $id)->with(['alumni', 'domain'])->firstOrFail();
    }

    public function customerTransaction($id)
    {
        $customer_transaction = Transaction::where('user_id', $id);

        return datatables($customer_transaction)
            ->addIndexColumn()

            ->addColumn('date', function ($data) {
                return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('jS F, h:i:s A');
            })
            ->rawColumns(['date'])
            ->make(true);
    }

    public function domainInformation($id)
    {
        return CustomDomainRequest::where('user_id', $id)->orderBy('id', 'DESC')->get();
    }

}
