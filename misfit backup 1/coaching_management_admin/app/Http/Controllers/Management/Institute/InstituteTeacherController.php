<?php

namespace App\Http\Controllers\Management\Institute;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\Institute\InstituteBranch;
use App\Models\Institute\InstituteClassBatchExam;
use App\Models\Institute\InstituteTeacher;
use App\Models\User;
use App\Models\UserSalary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class InstituteTeacherController extends Controller
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

        $status = 1;
        if (request()->has('status')) {
            $status = request()->status;
        }

        $query = InstituteTeacher::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('education', 'LIKE', '%' . $key . '%')
                    ->orWhere('hire_date', 'LIKE', '%' . $key . '%')
                    ->orWhereHas('user', function ($q) use ($key) {
                        $q->where('first_name', 'LIKE', '%' . $key . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $key . '%')
                        ->orWhere('mobile_number', 'LIKE', '%' . $key . '%')
                        ->orWhere('email', 'LIKE', '%' . $key . '%')
                        ->orWhere('designation', 'LIKE', '%' . $key . '%')
                        ->orWhere('salary', 'LIKE', '%' . $key . '%')
                        ->orWhere('first_name', $key)
                        ->orWhere('first_name', $key)
                        ->orWhere('mobile_number', $key);
                    });
            });
        }

        if(request()->has('status')) {
            $query->where('status', $status);
        }

        
        $InstituteTeachers = $query->whereExists(
        function($query) {  
            $query->from('institute_branch_institute_teacher')
                ->where('institute_branch_institute_teacher.institute_branch_id', $this->getBranchID())
                ->whereColumn('institute_branch_institute_teacher.institute_teacher_id', 'institute_teachers.id');
        })->with(['user'])->paginate($paginate);

        $InstituteTeachers = $query->paginate($paginate);
        return response()->json($InstituteTeachers);
    }

    public function admin_teachers()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $status = 1;
        if (request()->has('status')) {
            $status = request()->status;
        }

        $query = InstituteTeacher::with(['user' => function($qUser) {
            $qUser->with('branch_user');
        }])->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('education', 'LIKE', '%' . $key . '%')
                    ->orWhere('hire_date', 'LIKE', '%' . $key . '%')
                    ->orWhereHas('user', function ($q) use ($key) {
                        $q->where('first_name', 'LIKE', '%' . $key . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $key . '%')
                        ->orWhere('mobile_number', 'LIKE', '%' . $key . '%')
                        ->orWhere('email', 'LIKE', '%' . $key . '%')
                        ->orWhere('designation', 'LIKE', '%' . $key . '%')
                        ->orWhere('salary', 'LIKE', '%' . $key . '%')
                        ->orWhere('first_name', $key)
                        ->orWhere('first_name', $key)
                        ->orWhere('mobile_number', $key);
                    });
            });
        }

        if(request()->has('status')) {
            $query->where('status', $status);
        }

        if (request()->has('branch_id')) {
            $query->whereHas('user.branch_user', function ($subQuery) {
                $subQuery->where('institute_branch_id', request()->branch_id);
            });
        }
        
        $InstituteTeachers = $query->paginate($paginate);

        return response()->json($InstituteTeachers);
    }

    public function show($id)
    {
        $data = InstituteTeacher::where('id',$id)->with(['batch','user' => function($q) {
            $q->with(['salary_statements', 'branch_user']);
        }])->first();
        if(!$data){
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['role'=>['data not found']],
            ], 422);
        }
        $stats = [];
        $teacher_batchs = $data->batch;
        
        foreach ($teacher_batchs as $key => $value) {
            $stats['total_student'] = $value->institute_students->count();

            $stats['total_exam'] = InstituteClassBatchExam::where('institute_class_batch_id', $value->id)->count();
        }
        $stats['total_batch'] = $teacher_batchs->count();

        $stats['total_attendences'] = Attendence::where('table', 'users')->where('table_id', $data->user_id)->count();


        $stats = (object) $stats;

        return response()->json(['teacher' => $data, 'stats' => $stats],200);
    }

    public function single_teacher_attendence_by_id($id) : object {
        $attendence = Attendence::where('table_id', $id)
        ->where('table', "employee")->with(['user'])
        ->get();
        
        return response()->json($attendence);
    }

    public function admin_show($id)
    {
        $data = InstituteTeacher::where('id',$id)->with(['batch','user' => function($q) {
            $q->with(['salary_statements']);
        }])->first();
        if(!$data){
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['role'=>['data not found']],
            ], 422);
        }
        $stats = [];
        $teacher_batchs = $data->batch;
        
        foreach ($teacher_batchs as $key => $value) {
            $stats['total_student'] = $value->institute_students->count();

            $stats['total_exam'] = InstituteClassBatchExam::where('institute_class_batch_id', $value->id)->count();
        }
        $stats['total_batch'] = $teacher_batchs->count();

        $stats['total_attendences'] = Attendence::where('table', 'users')->where('table_id', $data->user_id)->count();


        $stats = (object) $stats;

        return response()->json(['teacher' => $data, 'stats' => $stats],200);
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'user_first_name' => ['required'],
            'user_last_name' => ['required'],
            'email' => ['required','unique:users'],
            'hire_date' => ['required'],
            'user_password' => ['required', 'min:8', 'confirmed'],
            'user_password_confirmation' => ['required'],
            'mobile_number' => ['required', 'unique:users'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = new User();
        $user->first_name = request()->user_first_name;
        $user->last_name = request()->user_last_name;
        $user->user_name = request()->user_first_name . request()->user_last_name . rand(0, 9999);
        $user->total_monthly_attendance = request()->total_monthly_attendance;
        $user->mobile_number = request()->mobile_number;
        $user->salary = request()->salary;
        $user->designation = request()->designation;
        $user->address = request()->user_address;
        $user->email = request()->email;
        $user->password = Hash::make(request()->user_password);
        $user->save();

        $user->roles()->attach(4);
        $user->branch_user()->attach([$this->getBranchID()]);

        try {
            if (request()->hasFile('photo')) {
                $file = request()->file('photo');
                $path = 'uploads/users/pp-' . $user->id . rand(1000, 9999) . '.';
                $height = 200;
                $width = 200;
                
                $path .= $file->getClientOriginalExtension();
                Image::make($file)->fit($height, $width)->save(public_path($path));
                $user->photo = $path;
                
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json("data created without image uploding-" . $th->getMessage(), 500);
        }

        $branch = InstituteBranch::where('id', $this->getBranchID())->first();
        $user->branch_code = Str::slug("$branch->name $user->id", '-'); 
        $user->save();

        $data = new InstituteTeacher();
        $data->user_id = $user->id;
        $data->education = request()->education;
        $data->hire_date = Carbon::parse(request()->hire_date)->toDateString();
        $data->slug = Str::random(8);
        $data->creator = auth()->user()->id;
        $data->save();
        $data->branch()->attach([$branch->id]);

        $user_salary = new UserSalary();
        $user_salary->user_id = $user->id;
        $user_salary->branch_id = $this->getBranchID();
        $salary =  request()->salary;
        $user_salary->salary =  floatval($salary);
        $user_salary->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'user_id' => ['required'],
            'hire_date' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new InstituteTeacher();
        $data->user_id = request()->user_id;
        $data->education = request()->education;
        $data->hire_date = Carbon::parse(request()->hire_date)->toDateString();
        $data->slug = Str::random(8);
        $data->creator = auth()->user()->id;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        
        $data = InstituteTeacher::find(request()->id);
        $user = User::find($data->user_id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['InstituteTeacher not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'hire_date' => ['required'],
        ]);

        if (request()->has('password') && request()->password) {
            $validator['password'] = ['required', 'min:8', 'confirmed'];
            $validator['password_confirmation'] = ['required'];
        }
        if (request()->user_email != $user->user_email) {
            $rules['user_email'][] = 'unique:users';
        }
        if (request()->mobile_number != $user->mobile_number) {
            $rules['mobile_number'][] = 'unique:users';
        }

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user->first_name = request()->user_first_name;
        $user->last_name = request()->user_last_name;
        $user->user_name = request()->user_first_name . request()->user_last_name . rand(0, 9999);
        $user->mobile_number = request()->mobile_number;
        $user->total_monthly_attendance = request()->total_monthly_attendance;
        $user->salary = request()->salary;
        $user->designation = request()->designation;
        $user->email = request()->user_email;
        $user->address = request()->user_address;
        $user->save();

        $user->roles()->sync(4);
        $user->branch_user()->sync([$this->getBranchID()]);
        try {
            if (request()->hasFile('photo')) {
                if(file_exists(public_path() . '/' .$user->photo)){
                    unlink(public_path() . '/' .$user->photo);
                }
                $file = request()->file('photo');
                $path = 'uploads/users/pp-' . $user->id . rand(1000, 9999) . '.';
                $height = 200;
                $width = 200;
                
                $path .= $file->getClientOriginalExtension();
                Image::make($file)->fit($height, $width)->save(public_path($path));
                $user->photo = $path;
                
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json("data created without image uploding-" . $th->getMessage(), 500);
        }

        $user->save();

        $branch = InstituteBranch::where('id', $this->getBranchID())->first();

        $data->user_id = $user->id;
        $data->education = request()->education;
        $data->hire_date = Carbon::parse(request()->hire_date)->toDateString();
        $data->creator = auth()->user()->id;
        $data->save();
        $data->branch()->syncWithoutDetaching([$branch->id]);

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = InstituteTeacher::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['InstituteTeacher not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'user_id' => ['required'],
            'hire_date' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->user_id = request()->user_id;
        $data->education = request()->education;
        $data->hire_date = Carbon::parse(request()->hire_date)->toDateString();
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:institute_teachers,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = InstituteTeacher::where('id', request()->id)->delete();

        return response()->json([
            'result' => 'deleted',
        ], 200);
    }

    public function soft_delete()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:institute_teachers,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = InstituteTeacher::find(request()->id);
        $data->status = 0;
        $data->save();

        return response()->json([
            'result' => 'deactivated',
        ], 200);
    }

    public function restore()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:institute_teachers,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = InstituteTeacher::find(request()->id);
        $data->status = 1;
        $data->save();

        return response()->json([
            'result' => 'activated',
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
            $check = InstituteTeacher::where('id',$item->id)->first();
            if(!$check){
                try {
                    InstituteTeacher::create((array) $item);
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
