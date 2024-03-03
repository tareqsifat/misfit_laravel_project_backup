<?php

namespace App\Http\Services\addon\saas;

use App\Models\Currency;
use App\Models\FileManager;
use App\Models\Gateway;
use App\Models\GatewayCurrency;
use App\Models\Package;
use App\Models\SubscriptionOrder;
use App\Models\User;
use App\Models\UserPackage;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class PackageService
{
    use ResponseTrait;
    public function getAllData($request)
    {
        $packages = Package::query();

        return datatables($packages)
            ->addIndexColumn()
            ->addColumn('name', function ($package) {
                return $package->name;
            })
            ->addColumn('icon', function ($data) {
                return '<div class="min-w-160 d-flex align-items-center cg-10">
                            <div class="flex-shrink-0 w-35 h-35 bd-one bd-c-cdef84 rounded-circle overflow-hidden bg-eaeaea d-flex justify-content-center align-items-center">
                                <img src="' . getFileUrl($data->icon_id) . '" alt="icon" class="rounded avatar-xs w-100">
                            </div>
                        </div>';
            })
            ->addColumn('monthly_price', function ($package) {
                return showPrice($package->monthly_price);
            })
            ->addColumn('yearly_price', function ($package) {
                return showPrice($package->yearly_price);
            })
            ->addColumn('status', function ($package) {
                if ($package->status == STATUS_ACTIVE) {
                    return '<div class="status-btn status-btn-green font-13 radius-4">' . __('Active') . '</div>';
                } else {
                    return '<div class="status-btn status-btn-orange font-13 radius-4">' . __('Deactivate') . '</div>';
                }
            })
            ->addColumn('action', function ($package) {
                return '<div class="d-flex justify-content-end align-items-center cg-10">
                    <button onclick="getEditModal(\'' . route('saas.super_admin.packages.edit', $package->id) . '\'' . ', \'#edit-modal\')" class="btn p-1 tbl-action-btn" title="'.__('Edit').'">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button onclick="deleteItem(\'' . route('saas.super_admin.packages.destroy', $package->id) . '\', \'packageDataTable\')" class="btn p-1 tbl-action-btn text-danger"   title="' . __('Delete') . '"><i class="fa fa-trash-can"></i></button>
                </div>';
            })
            ->rawColumns(['name', 'icon', 'status', 'trail', 'action'])
            ->make(true);
    }

    public function getAll()
    {
        return Package::query()->get();
    }

    public function getActiveAll()
    {
        return Package::where('status', STATUS_ACTIVE)->where('is_trail', '!=', ACTIVE)->get();
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $id = $request->get('id', '');
            if ($id != '') {
                $package = Package::findOrFail($request->id);
            } else {
                $package = new Package();
            }

            if (Package::where('slug', getSlug($request->name))->withTrashed()->count() > 0) {
                $slug = getSlug($request->name) . '-' . rand(100000, 999999);
            } else {
                $slug = getSlug($request->name);
            }

            if ($request->hasFile('icon')) {
                $newFile = new FileManager();
                $uploaded = $newFile->upload('Package', $request->icon);

                if (!is_null($uploaded)) {
                    $package->icon_id = $uploaded->id;
                } else {
                    return $this->error([], getMessage(SOMETHING_WENT_WRONG));
                }
            }

            $package->name = $request->name;
            $package->slug = $slug;
            $package->description = $request->description;
            $package->alumni_limit = $request->alumni_limit_type == STATUS_ACTIVE ? $request->alumni_limit : UNLIMITED;
            $package->event_limit = $request->event_limit_type == STATUS_ACTIVE ? $request->event_limit : UNLIMITED;
            $package->custom_domain = $request->custom_domain ? STATUS_ACTIVE : STATUS_PENDING;
            $package->others = json_encode($request->others ?? []);
            $package->status = $request->status ? ACTIVE : DEACTIVATE;
            $package->is_trail = $request->is_trail ? ACTIVE : DEACTIVATE;
            $package->is_default = $request->is_default ? ACTIVE : DEACTIVATE;
            $package->monthly_price = $request->monthly_price;
            $package->yearly_price = $request->yearly_price;
            $package->save();

            DB::commit();
            $message = $request->id ? __(UPDATED_SUCCESSFULLY) : __(CREATED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

    public function getInfo($id)
    {
        return Package::findOrFail($id);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            if (Package::where('status', ACTIVE)->count() > 1) {
                Package::findOrFail($id)->delete();

                // update if trail changed
                if (is_null(Package::where(['is_trail' => ACTIVE, 'status' => STATUS_ACTIVE])->first())) {
                    Package::where(['status' => STATUS_ACTIVE])->first()->update(['is_trail' => ACTIVE]);
                }

                DB::commit();
                $message = __(DELETED_SUCCESSFULLY);
                return $this->success([], $message);
            } else {
                $message = __("Trial package can not be deleted");
                return $this->error([], $message);
            }
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

    public function getUserPackagesData()
    {
        $ownerPackages = UserPackage::query()
            ->join('users', 'user_packages.user_id', '=', 'users.id')
            ->join('packages', 'user_packages.package_id', '=', 'packages.id')
            ->leftJoin('payments', 'user_packages.payment_id', '=', 'payments.id')
            ->leftJoin('gateways', 'payments.gateway_id', '=', 'gateways.id')
            ->select('user_packages.*', 'users.name as userName',
                'users.email',
                'packages.name as packageName',
                'gateways.title as gateway_title')
            ->orderBy('user_packages.id', 'desc');
        return datatables($ownerPackages)
            ->addIndexColumn()
            ->addColumn('user_name', function ($ownerPackage) {
                return $ownerPackage->userName;
            })
            ->addColumn('package_name', function ($ownerPackage) {
                return $ownerPackage->packageName;
            })
            ->addColumn('gateway_name', function ($ownerPackage) {
                return $ownerPackage->gateway_title ?? 'N/A';
            })
            ->addColumn('start_date', function ($ownerPackage) {
                return date('Y-m-d', strtotime($ownerPackage->start_date));
            })
            ->addColumn('end_date', function ($ownerPackage) {
                return date('Y-m-d', strtotime($ownerPackage->end_date));
            })
            ->addColumn('status', function ($ownerPackage) {
                if ($ownerPackage->status == STATUS_ACTIVE && $ownerPackage->end_date >= now()) {
                    return '<div class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-0fa958 bg-0fa958-10">' . __('Active') . '</div>';
                } elseif ($ownerPackage->status == STATUS_REJECT ) {
                    return '<div class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-f5b40a bg-f5b40a-10">' . __('Rejected') . '</div>';
                } else {
                    return '<div class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-ea4335 bg-ea4335-10">' . __('Expired') . '</div>';
                }
            })
            ->rawColumns(['user_name', 'package_name', 'start_date', 'end_date', 'status', 'action'])
            ->make(true);
    }

    public function assignPackage($request)
    {
        DB::beginTransaction();
        try {
            $package = Package::findOrFail($request->package_id);
            $user = User::where('role', USER_ROLE_ADMIN)->findOrFail($request->user_id);

            UserPackage::where('tenant_id', $user->tenant_id)->where('user_id', $request->user_id)->where('end_date', '>=', now())->update(['status' => STATUS_REJECT]);

            $expiredDate = $request->duration_type == SUBSCRIPTION_TYPE_MONTHLY ? now()->addMonth() : now()->addYear();

             UserPackage::create([
                'user_id' => $user->id,
                'tenant_id' => $user->tenant_id,
                'package_id' => $package->id,
                'start_date' => now(),
                'end_date' => $expiredDate,
                'subscription_type' => $request->duration_type,
                'status' => STATUS_ACTIVE,
            ]);

            DB::commit();
            return $this->success([], __('Assigned Successful'));
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }
}
