<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Institute\InstituteClassBatch;
use App\Models\Institute\InstituteClassBatchTimeSchedule;
use App\Models\User;
use App\Models\UserManagement\Notification;
use App\Models\UserManagement\NotificationUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{

    // get the branch admin details from auth
    private function getBranchID() {
        $branch_admin = auth()->user()->load('branch_admin');
        
        return $branch_admin->branch_admin[0]->branch_details->id;
    }

    public function all()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;


        $query = Notification::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('title', $key)
                    ->orWhere('title', 'LIKE', '%' . $key . '%')
                    ->orWhere('date', 'LIKE', '%' . $key . '%')
                    ->orWhere('description', 'LIKE', '%' . $key . '%');
            });
        }

        $users = $query->with(['notification_user' => function($q) {
            $q->with('user');
        }])->paginate($paginate);
        return response()->json($users);
    }

    public function user_notification_update() : object {
        
        $user_notification = NotificationUser::where('user_id', auth()->user()->id)->update([
            "seen" => 1
        ]);
        
        // $user_notification->seen = 1;
        // $user_notification->save();

        return response()->json(["messsage" => "notifications status changed to seen"]);
    }

    public function update_notification_unread() : object {
        // dd(request()->all());
        $user_notification = NotificationUser::where('id', request()->id)->update([
            "seen" => 0
        ]);

        return response()->json(["messsage" => "notifications status changed to unseen"]);
    }

    public function show($id)
    {
        $data = Notification::where('id',$id)->with('notification_user')->first();
        if(!$data){
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['role'=>['data not found']],
            ], 422);
        }
        return response()->json($data,200);
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'description' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new Notification();
        $data->title = request()->title;
        $data->description = request()->description;
        $data->date = Carbon::parse(request()->date);
        $data->save();

        if(request()->has('user_type')) {

            // sent notifications to all users
            if(request()->user_type == 'all_users') {
                $users = User::where('status', 1)->select('id', 'first_name', 'last_name')->get();
                foreach ($users as $key => $value) {
                    $notification_user = new NotificationUser();
                    $notification_user->user_id = $value->id;
                    $notification_user->notification_id = $data->id;
                    $notification_user->seen = 0;
                    $notification_user->save();
                }
            }

            // sent notifications to all students
            if(request()->user_type == 'all_students') {
                $query = User::where('status', 1);

                $users = $query->whereExists(
                    function($query) {  
                        $query->from('user_user_role')
                            ->where('user_user_role.user_role_id', 6)
                            ->whereColumn('user_user_role.user_id', 'users.id');
                    })->whereExists(function($query) {  
                        $query->from('institute_branch_user')
                            ->where('institute_branch_user.institute_branch_id', $this->getBranchID())
                            ->whereColumn('institute_branch_user.user_id', 'users.id');
                    })
                    ->get();
                
                foreach ($users as $key => $value) {
                    $notification_user = new NotificationUser();
                    $notification_user->user_id = $value->id;
                    $notification_user->notification_id = $data->id;
                    $notification_user->seen = 0;
                    $notification_user->save();
                }
                
            }

            // sent notifications to all teachersp
            if(request()->user_type == 'all_teachers') {
                $query = User::where('status', 1);

                $users = $query->whereExists(
                    function($query) {  
                        $query->from('user_user_role')
                            ->where('user_user_role.user_role_id', 4)
                            ->whereColumn('user_user_role.user_id', 'users.id');
                    })->whereExists(function($query) {  
                        $query->from('institute_branch_user')
                            ->where('institute_branch_user.institute_branch_id', $this->getBranchID())
                            ->whereColumn('institute_branch_user.user_id', 'users.id');
                        })
                    ->get();
                // dd($users);
                foreach ($users as $key => $value) {
                    $notification_user = new NotificationUser();
                    $notification_user->user_id = $value->id;
                    $notification_user->notification_id = $data->id;
                    $notification_user->seen = 0;
                    $notification_user->save();
                }
            }
        }

        if(request()->has('users')) {
            
            $users = request()->users;
            if(is_array($users)) {
                foreach ($users as $key => $user) {
                    $notification_user = new NotificationUser();
                    $notification_user->user_id = $user;
                    $notification_user->notification_id = $data->id;
                    $notification_user->seen = 0;
                    $notification_user->save();
                }
            }else {
                $notification_user = new NotificationUser();
                $notification_user->user_id = $users;
                $notification_user->notification_id = $data->id;
                $notification_user->seen = 0;
                $notification_user->save();
            }
        }

        return response()->json($data, 200);
    }

    public function batch_notification() {
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'description' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new Notification();
        $data->title = request()->title;
        $data->description = request()->description;
        $data->date = Carbon::parse(request()->date);
        $data->save();

        $batch = InstituteClassBatch::where('id', request()->batch_id)->with(['batch_teachers', 'institute_students'])->first();
        $teacher_query = InstituteClassBatchTimeSchedule::where('institute_class_batch_id', request()->batch_id)
        ->with(['teacher'])->select('institute_class_batch_id', 'id', 'institute_class_teacher_id')->get()->unique('institute_class_teacher_id');
        // dd($batch->institute_students->toArray());
        $batch_teacher_array = [];
        foreach ($teacher_query as $key => $teach) {
            array_push($batch_teacher_array, $teach->teacher);

        }
        
        if(request()->user_type == 'all_users_batch') {
            
            foreach ($batch_teacher_array as $key => $techer) {
                
                $notification_user = new NotificationUser();
                $notification_user->user_id = $techer->user_id;
                $notification_user->notification_id = $data->id;
                $notification_user->seen = 0;
                $notification_user->save();
            }
            foreach ($batch->institute_students as $key => $std) {
                $notification_user = new NotificationUser();
                $notification_user->user_id = $std->user_id;
                $notification_user->notification_id = $data->id;
                $notification_user->seen = 0;
                $notification_user->save();
            }
        }

        // sent notifications to all students
        if(request()->user_type == 'all_students_batch') {
            foreach ($batch->institute_students as $key => $std) {
                $notification_user = new NotificationUser();
                $notification_user->user_id = $std->user_id;
                $notification_user->notification_id = $data->id;
                $notification_user->seen = 0;
                $notification_user->save();
            }
        }

        // sent notifications to all teachersp
        if(request()->user_type == 'all_teachers_batch') {
            
            foreach ($batch_teacher_array as $key => $teacher) {
                $notification_user = new NotificationUser();
                $notification_user->user_id = $teacher->user_id;
                $notification_user->notification_id = $data->id;
                $notification_user->seen = 0;
                $notification_user->save();
            }
        }

        return response()->json($data, 200);
    }

    public function all_users()
    {
        $query = User::where('status', 1);

        $users = $query->whereExists(function($query) {  
                $query->from('institute_branch_user')
                    ->where('institute_branch_user.institute_branch_id', $this->getBranchID())
                    ->whereColumn('institute_branch_user.user_id', 'users.id');
                })
                ->get();
            
        return response()->json($users);
        
    }

    

    public function update()
    {
        $data = Notification::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['branch not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'description' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->name = request()->name;
        $data->description = request()->description;
        $data->date = Carbon::parse(request()->date);
        $data->save();


        if(request()->has('all_user')) {
            $users = User::where('status', 1)->select('id', 'first_name', 'last_name')->get();
            foreach ($users as $key => $value) {
                $notification_user = NotificationUser::where('notification_id', request()->id)->first();
                $notification_user->user_id = $value->id;
                $notification_user->notification_id = $data->id;
                $notification_user->seen = 0;
                $notification_user->save();
            }
        }

        if(request()->has('users')) {
            $users = request()->users;
            if(is_array($users)) {
                foreach ($users as $key => $user) {
                    $notification_user = NotificationUser::where('notification_id', request()->id)->first();
                    $notification_user->user_id = $user;
                    $notification_user->notification_id = $data->id;
                    $notification_user->seen = 0;
                    $notification_user->save();
                }
            }else {
                $notification_user = NotificationUser::where('notification_id', request()->id)->first();
                $notification_user->user_id = $users;
                $notification_user->notification_id = $data->id;
                $notification_user->seen = 0;
                $notification_user->save();
            }
        }

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        
    }

    public function soft_delete()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:institute_branches,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = NotificationUser::find(request()->id);
        $data->status = 0;
        $data->save();

        return response()->json([
            'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:notifications,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        Notification::where('id', request()->id)->delete();
        NotificationUser::where('notification_id', request()->id)->delete();

        return response()->json([
            'result' => 'deleted',
        ], 200);
    }

    public function bulk_import()
    {
        $validator = Validator::make(request()->all(), [
            'data' => ['required','array'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        foreach (request()->data as $item) {
            $item['created_at'] = $item['created_at'] ? Carbon::parse($item['created_at']): Carbon::now()->toDateTimeString();
            $item['updated_at'] = $item['updated_at'] ? Carbon::parse($item['updated_at']): Carbon::now()->toDateTimeString();
            $item = (object) $item;
            $check = NotificationUser::where('id',$item->id)->first();
            if(!$check){
                try {
                    NotificationUser::create((array) $item);
                } catch (\Throwable $th) {
                    return response()->json([
                        'err_message' => 'validation error',
                        'errors' => $th->getMessage(),
                    ], 400);
                }
            }
        }

        return response()->json('success', 200);
    }
}
