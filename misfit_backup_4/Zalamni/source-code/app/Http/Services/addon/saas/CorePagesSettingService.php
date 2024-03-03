<?php

namespace App\Http\Services\addon\saas;


use App\Models\CorePagesSetting;
use App\Traits\ResponseTrait;
use App\Models\FileManager;
use Exception;
use Illuminate\Support\Facades\DB;

class CorePagesSettingService
{
    use ResponseTrait;

    public function list(){
        $features = CorePagesSetting::query();
        return datatables($features)
            ->addIndexColumn()
            ->addColumn('image', function ($data) {
                return '<img src="' . getFileUrl($data->image) . '" alt="icon" class="rounded avatar-xs tbl-user-image w-25 h-32">';
            })
            ->addColumn('status', function ($data) {
                if ($data->status == STATUS_ACTIVE) {
                    return '<span class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-0fa958 bg-0fa958-10">'.__("Active").'</span>';
                } else {
                    return '<span class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-ea4335 bg-ea4335-10">'.__("Deactivate").'</span>';
                }
            })
            ->addColumn('action', function ($data) {
                return '<ul class="d-flex align-items-center cg-5 justify-content-end">
                            <li class="d-flex gap-1">
                                <button onclick="getEditModal(\'' . route('saas.super_admin.frontend-setting.core-page.edit', $data->id) . '\'' . ', \'#edit-modal\')" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one border-0 bd-c-ededed bg-white" data-bs-toggle="modal" data-bs-target="#alumniPhoneNo" title="Edit">
                                    <img src="' . asset('assets/images/icon/edit.svg') . '" alt="edit" />
                                </button>
                                <button onclick="deleteItem(\'' . route('saas.super_admin.frontend-setting.core-page.delete', $data->id) . '\', \'corePageDataTable\')" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle border-0 bd-one bd-c-ededed bg-white" title="Delete">
                                    <img src="' . asset('assets/images/icon/delete-1.svg') . '" alt="delete">
                                </button>
                            </li>
                        </ul>';
            })
            ->rawColumns(['status', 'image', 'action'])
            ->make(true);
    }

    public function bestFeaturesStore($request){

        try {
            DB::beginTransaction();

            $id = $request->get('id', 0);
            $features = CorePagesSetting::find($id);
            if (is_null($features)) {
                $features = new CorePagesSetting();
            }
            $features->name = $request->name;
            $features->title = $request->title;
            $features->description = $request->description;
            $features->status = isset($request->status) ? $request->status : ACTIVE;

            if ($request->hasFile('image')) {
                $new_file = new FileManager();
                $uploaded = $new_file->upload('featuresSetting', $request->image);
                $features->image = $uploaded->id;
            }

            $features->save();
            DB::commit();
            return $this->success([], getMessage(CREATED_SUCCESSFULLY));
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->error([], getMessage(SOMETHING_WENT_WRONG));
        }
    }

    public function featuresDelete($id)
    {
        try {
            $data = CorePagesSetting::find($id);
            $data->delete();
            return $this->success([], getMessage(DELETED_SUCCESSFULLY));
        } catch (Exception $exception) {
            return $this->error([], getMessage(SOMETHING_WENT_WRONG));
        }
    }

}
