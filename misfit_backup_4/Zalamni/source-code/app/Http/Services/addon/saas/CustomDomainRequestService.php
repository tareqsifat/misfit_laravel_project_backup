<?php

namespace App\Http\Services\addon\saas;

use App\Models\CustomDomainRequest;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\Database\Models\Domain;

class CustomDomainRequestService
{
    use ResponseTrait;

    public function list()
    {
        $customDomain = CustomDomainRequest::where('tenant_id', getTenantId())->orderBy('id', 'DESC');
        return datatables($customDomain)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->status == STATUS_ACTIVE) {
                    return '<span class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-0fa958 bg-0fa958-10">' . __("Approved") . '</span>';
                } else if ($data->status == STATUS_PENDING) {
                    return '<span class="zBadge-free">' . __("Pending") . '</span>';
                } else {
                    return '<span class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-ea4335 bg-ea4335-10">' . __("Rejected") . '</span>';
                }
            })
            ->addColumn('action', function ($data){
                $return = '<ul class="d-flex align-items-center cg-5 justify-content-center">
                        <li class="d-flex gap-2">';
                if($data->status != STATUS_ACTIVE){
                    $return .= '<button onclick="getEditModal(\'' . route('admin.custom_domain.info', $data->id) . '\'' . ', \'#edit-modal\')" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white">
                        <img src="' . asset('assets/images/icon/edit.svg') . '" alt="edit" />
                    </button>';
                }
                $return .= '
                    </li>
                </ul>';

                return $return;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function superAdminlist()
    {
        $customDomains = CustomDomainRequest::orderBy('id', 'DESC');
        return datatables($customDomains)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->status == STATUS_ACTIVE) {
                    return '<span class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-0fa958 bg-0fa958-10">' . __("Approved") . '</span>';
                } else if ($data->status == STATUS_PENDING) {
                    return '<span class="zBadge-free">' . __("Pending") . '</span>';
                } else {
                    return '<span class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-ea4335 bg-ea4335-10">' . __("Rejected") . '</span>';
                }
            })
            ->addColumn('action', function ($data){
                $return = '<ul class="d-flex align-items-center cg-5 justify-content-center">
                        <li class="d-flex gap-2">';
                if($data->status != STATUS_ACTIVE){
                    $return .= '<button onclick="getEditModal(\'' . route('saas.super_admin.custom_domain.info', $data->id) . '\'' . ', \'#edit-modal\')" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white">
                        <img src="' . asset('assets/images/icon/edit.svg') . '" alt="edit" />
                    </button>';
                }
                $return .= '<a href="'. route('saas.super_admin.customer_details', $data->user_id) .'" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" title="View">
                            <img src="' . asset('assets/images/icon/eye.svg') . '" alt="view">
                        </a>
                    </li>
                </ul>';

                return $return;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            if (CustomDomainRequest::where('tenant_id', getTenantId())->where('status', STATUS_PENDING)->first()) {
                $message = __('Already have a request');
                return $this->error([], $message);
            }
            CustomDomainRequest::create([
                'tenant_id' => getTenantId(),
                'user_id' => auth()->id(),
                'old_domain' => $request->old_domain,
                'request_domain' => $request->request_domain,
                'status' => STATUS_PENDING,
            ]);

            DB::commit();

            $message = getMessage(CREATED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $customDomain = CustomDomainRequest::where('id', $id)->first();
            $customDomain->update([
                'old_domain' => $request->old_domain,
                'request_domain' => $request->request_domain,
                'status' => $request->status ?? STATUS_PENDING,
            ]);

            if( $request->status == STATUS_ACTIVE && auth()->user()->role == USER_ROLE_SUPER_ADMIN){
                Domain::where('tenant_id', $customDomain->tenant_id)->where('domain', $customDomain->old_domain)->update([
                    'domain' => $customDomain->request_domain
                ]);
            }

            DB::commit();

            $message = getMessage(UPDATED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

    public function getById($id)
    {
        $package = CustomDomainRequest::findOrFail($id);
        return $package?->makeHidden(['created_at', 'deleted_at', 'updated_at']);
    }
}
