<?php

namespace App\Http\Services\addon\saas;

use App\Traits\ResponseTrait;
use App\Models\FileManager;
use App\Models\HowItsWork;
use Exception;
use Illuminate\Support\Facades\DB;

class HowItsWorkService
{
    use ResponseTrait;

    public function list(){
        $work = HowItsWork::query();
        return datatables($work)
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
                                <button onclick="getEditModal(\'' . route('saas.super_admin.frontend-setting.how-its-works.edit', $data->id) . '\'' . ', \'#edit-modal\')" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one border-0 bd-c-ededed bg-white" data-bs-toggle="modal" data-bs-target="#alumniPhoneNo" title="Edit">
                                    <img src="' . asset('assets/images/icon/edit.svg') . '" alt="edit" />
                                </button>
                                <button onclick="deleteItem(\'' . route('saas.super_admin.frontend-setting.how-its-works.delete', $data->id) . '\', \'howItsWorkDataTable\')" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle border-0 bd-one bd-c-ededed bg-white" title="Delete">
                                    <img src="' . asset('assets/images/icon/delete-1.svg') . '" alt="delete">
                                </button>
                            </li>
                        </ul>';
            })
            ->rawColumns(['status', 'icon', 'image', 'action'])
            ->make(true);
    }

    public function store($request){
        try {
            DB::beginTransaction();

            $id = $request->get('id', 0);
            $work = HowItsWork::find($id);
            if (is_null($work)) {
                $work = new HowItsWork();
            }
            $work->title = $request->title;
            $work->name = $request->name;
            $work->description = $request->description;
            $work->status = isset($request->status) ? $request->status : ACTIVE;

            if ($request->hasFile('image')) {
                $new_file = new FileManager();
                $uploaded = $new_file->upload('howItsWork', $request->image);
                $work->image = $uploaded->id;
            }
            $work->save();
            DB::commit();
            return $this->success([], getMessage(CREATED_SUCCESSFULLY));
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->error([], getMessage(SOMETHING_WENT_WRONG));
        }
    }

    public function delete($id)
    {
        try {
            $data = HowItsWork::find($id);
            $data->delete();
            return $this->success([], getMessage(DELETED_SUCCESSFULLY));
        } catch (Exception $exception) {
            return $this->error([], getMessage(SOMETHING_WENT_WRONG));
        }
    }

}
