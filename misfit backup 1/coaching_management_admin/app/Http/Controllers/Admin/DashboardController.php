<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accounts\BranchAccountLog;
use App\Models\Attendence;
use App\Models\CRM\Customers;
use App\Models\Institute\InstituteClassBatch;
use App\Models\Institute\InstituteClassBatchExam;
use App\Models\Institute\InstituteClassBatchExamMark;
use App\Models\Institute\InstituteClassBatchTimeSchedule;
use App\Models\Institute\InstituteStudent;
use App\Models\Institute\InstituteTeacher;
use App\Models\NewsEvent;
use App\Models\Notice;
use App\Models\Order\ProductOrder;
use App\Models\Product\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private function getBranchID() {
        $branch_admin = auth()->user()->load('branch_admin');
        
        return $branch_admin->branch_admin[0]->branch_details->id;
    }

    public function get_dashboard_stats() {
        $data = [];
        $data['total_expense'] = BranchAccountLog::where('type', 'debit')->whereMonth('created_at', Carbon::now()->month)->where('is_expense', 1)->sum('amount');
        $data['total_income'] = BranchAccountLog::where('type', 'credit')->whereMonth('created_at', Carbon::now()->month)->where('is_income', 1)->sum('amount');
        $data['total_customers'] = Customers::whereMonth('created_at', Carbon::now()->month)->count();
        $data['total_orders'] = ProductOrder::whereMonth('created_at', Carbon::now()->month)->count();
        $data['total_batch'] = InstituteClassBatch::whereMonth('created_at', Carbon::now()->month)->count();
        $data['total_products'] = Product::whereMonth('created_at', Carbon::now()->month)->count();
        $data['total_students'] = InstituteStudent::whereMonth('created_at', Carbon::now()->month)->count();
        $data['total_teachers'] = InstituteTeacher::whereMonth('created_at', Carbon::now()->month)->count();

        $orders = [];
        $to = Carbon::today()->subMonths(5);
        $from = Carbon::today();
        $diff_in_months = $to->diffInMonths($from);


        $month_name = array();

        for ($i = $diff_in_months; $i >= 0; $i--) {
            $month = Carbon::today()->startOfMonth()->subMonth($i);
            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');
            array_push($month_name,
                $month->monthName,
            );
        }

        $order_total_data = [];
        $total_monthly_incomes = [];

        foreach($month_name as $month) {
            $month_no = Carbon::parse($month)->month;
            $order_data = ProductOrder::whereMonth('created_at', $month_no)->sum('total_amount');
            array_push($order_total_data, $order_data);

            $income = BranchAccountLog::whereMonth('created_at', $month_no)->where('type', 'credit')->where('is_income', 1)->sum('amount');
            array_push($total_monthly_incomes, $income);

        }

        
        
        $data['order_totals'] = $order_total_data;
        $data['monthly_income'] = $total_monthly_incomes;
        $data['month_name'] = $month_name;

        $data = (object) $data;
        // dd($month_name, $order_total, $order_month);

        return response()->json($data);
    }

    public function get_dashboard_stats_by_month($month) {
        // dd($month);
        $data = [];
        $month = (int) $month;
        $data['total_expense'] = BranchAccountLog::where('type', 'debit')->whereMonth('created_at', $month)->where('is_expense', 1)->sum('amount');
        $data['total_income'] = BranchAccountLog::where('type', 'credit')->whereMonth('created_at', $month)->where('is_income', 1)->sum('amount');
        $data['total_customers'] = Customers::whereMonth('created_at', $month)->count();
        $data['total_orders'] = ProductOrder::whereMonth('created_at', $month)->count();
        $data['total_batch'] = InstituteClassBatch::whereMonth('created_at', $month)->count();
        $data['total_products'] = Product::whereMonth('created_at', $month)->count();
        $data['total_students'] = InstituteStudent::whereMonth('created_at', $month)->count();
        $data['total_teachers'] = InstituteTeacher::whereMonth('created_at', $month)->count();

        $orders = [];
        $to = Carbon::today()->subMonths(5);
        $from = Carbon::today();
        $diff_in_months = $to->diffInMonths($from);


        $month_name = array();

        for ($i = $diff_in_months; $i >= 0; $i--) {
            $month = Carbon::today()->startOfMonth()->subMonth($i);
            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');
            array_push($month_name,
                $month->monthName,
            );
        }

        $order_total_data = [];
        $total_monthly_incomes = [];

        foreach($month_name as $month) {
            $month_no = Carbon::parse($month)->month;
            $order_data = ProductOrder::whereMonth('created_at', $month_no)->sum('total_amount');
            array_push($order_total_data, $order_data);

            $income = BranchAccountLog::whereMonth('created_at', $month_no)->where('type', 'credit')->where('is_income', 1)->sum('amount');
            array_push($total_monthly_incomes, $income);

        }

        
        
        $data['order_totals'] = $order_total_data;
        $data['monthly_income'] = $total_monthly_incomes;
        $data['month_name'] = $month_name;

        $data = (object) $data;
        // dd($month_name, $order_total, $order_month);
        return response()->json($data);

    }

    public function branch_dashboard_stats() : object {
        $data = [];
        $data['total_expense'] = BranchAccountLog::where('type', 'debit')->where('branch_id', $this->getBranchID())->where('is_expense', 1)->sum('amount');
        $data['total_income'] = BranchAccountLog::where('type', 'credit')->where('branch_id', $this->getBranchID())->where('is_income', 1)->sum('amount');
        $data['total_customers'] = Customers::where('branch_id', $this->getBranchID())->count();
        $data['total_orders'] = ProductOrder::where('user_id', auth()->user()->id)->count();
        $data['total_batch'] = InstituteClassBatch::where('branch_id', $this->getBranchID())->count();
        $data['total_products'] = Product::count();
        $data['total_students'] = InstituteStudent::whereExists(
            function($query) {  
                $query->from('institute_branch_institute_student')
                    ->where('institute_branch_institute_student.institute_branch_id', $this->getBranchID())
                    ->whereColumn('institute_branch_institute_student.institute_student_id', 'institute_students.id');
            })->count();
        $data['total_teachers'] = InstituteTeacher::whereExists(
            function($query) {  
                $query->from('institute_branch_institute_teacher')
                    ->where('institute_branch_institute_teacher.institute_branch_id', $this->getBranchID())
                    ->whereColumn('institute_branch_institute_teacher.institute_teacher_id', 'institute_teachers.id');
            })->count();

        $orders = [];
        $to = Carbon::today()->subMonths(5);
        $from = Carbon::today();
        $diff_in_months = $to->diffInMonths($from);

        $month_name = array();

        for ($i = $diff_in_months; $i >= 0; $i--) {
            $month = Carbon::today()->startOfMonth()->subMonth($i);
            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');
            array_push($month_name,
                $month->monthName,
            );
        }

        $order_total_data = [];
        $total_monthly_incomes = [];

        foreach($month_name as $month) {
            $month_no = Carbon::parse($month)->month;
            $order_data = ProductOrder::whereMonth('created_at', $month_no)->where('user_id', auth()->user()->id)->sum('total_amount');
            array_push($order_total_data, $order_data);

            $income = BranchAccountLog::whereMonth('created_at', $month_no)->where('branch_id', $this->getBranchID())
            ->where('type', 'credit')->where('is_income', 1)->sum('amount');
            array_push($total_monthly_incomes, $income);

        }
        
        $data['order_totals'] = $order_total_data;
        $data['monthly_income'] = $total_monthly_incomes;
        $data['month_name'] = $month_name;

        $data = (object) $data;
        // dd($month_name, $order_total, $order_month);

        return response()->json($data);
    }

    public function branch_dashboard_stats_by_month($month) {
        $data = [];
        $data['total_expense'] = BranchAccountLog::where('type', 'debit')->whereMonth('created_at', $month)->where('branch_id', $this->getBranchID())->where('is_expense', 1)->sum('amount');
        $data['total_income'] = BranchAccountLog::where('type', 'credit')->whereMonth('created_at', $month)->where('branch_id', $this->getBranchID())->where('is_income', 1)->sum('amount');
        $data['total_customers'] = Customers::where('branch_id', $this->getBranchID())->whereMonth('created_at', $month)->count();
        $data['total_orders'] = ProductOrder::where('user_id', auth()->user()->id)->whereMonth('created_at', $month)->count();
        $data['total_batch'] = InstituteClassBatch::where('branch_id', $this->getBranchID())->whereMonth('created_at', $month)->count();
        $data['total_products'] = Product::whereMonth('created_at', $month)->count();
        $data['total_students'] = InstituteStudent::whereMonth('created_at', $month)->whereExists(
            function($query) {  
                $query->from('institute_branch_institute_student')
                    ->where('institute_branch_institute_student.institute_branch_id', $this->getBranchID())
                    ->whereColumn('institute_branch_institute_student.institute_student_id', 'institute_students.id');
            })->count();
        $data['total_teachers'] = InstituteTeacher::whereMonth('created_at', $month)->whereExists(
            function($query) {  
                $query->from('institute_branch_institute_teacher')
                    ->where('institute_branch_institute_teacher.institute_branch_id', $this->getBranchID())
                    ->whereColumn('institute_branch_institute_teacher.institute_teacher_id', 'institute_teachers.id');
            })->count();

        $orders = [];
        $to = Carbon::today()->subMonths(5);
        $from = Carbon::today();
        $diff_in_months = $to->diffInMonths($from);

        $month_name = array();

        for ($i = $diff_in_months; $i >= 0; $i--) {
            $month = Carbon::today()->startOfMonth()->subMonth($i);
            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');
            array_push($month_name,
                $month->monthName,
            );
        }

        $order_total_data = [];
        $total_monthly_incomes = [];

        foreach($month_name as $month) {
            $month_no = Carbon::parse($month)->month;
            $order_data = ProductOrder::whereMonth('created_at', $month_no)->where('user_id', auth()->user()->id)->sum('total_amount');
            array_push($order_total_data, $order_data);

            $income = BranchAccountLog::whereMonth('created_at', $month_no)->where('branch_id', $this->getBranchID())
            ->where('type', 'credit')->where('is_income', 1)->sum('amount');
            array_push($total_monthly_incomes, $income);

        }
        
        $data['order_totals'] = $order_total_data;
        $data['monthly_income'] = $total_monthly_incomes;
        $data['month_name'] = $month_name;

        $data = (object) $data;
        // dd($month_name, $order_total, $order_month);

        return response()->json($data);
    }

    public function student_dashboard_stats() : object {
        $news = NewsEvent::take(6)->get();
        $Notice = Notice::take(6)->get();
        $data = [];
        $student = InstituteStudent::where('user_id', auth()->user()->id)->with(['institute_class_batches'])->first();
        $student_batchs = $student->institute_class_batches;
        
        foreach ($student_batchs as $key => $value) {
            $data['total_class'] = InstituteClassBatchTimeSchedule::where('institute_class_batch_id', $value->id)->count();
            $data['total_exam'] = InstituteClassBatchExam::where('institute_class_batch_id', $value->id)->count();
        }
        $data['total_batch'] = $student_batchs->count();

        $data['total_attendences'] = Attendence::where('table', 'users')->where('table_id', auth()->user()->id)->count();

        $data['avg_mark'] = InstituteClassBatchExamMark::where('user_id', auth()->user()->id)->avg('mark');
        $data['news'] = $news;
        $data['notice'] = $Notice;
        $data = (object) $data;

        return response()->json($data);
    }

    public function teacher_dashboard_stats() : object {
        $news = NewsEvent::take(6)->get();
        $Notice = Notice::take(6)->get();
        $data = [];
        $teacher = InstituteTeacher::where('user_id', auth()->user()->id)->with(['batch'])->first();
        $teacher_batchs = $teacher->batch;
        
        foreach ($teacher_batchs as $key => $value) {
            $data['total_student'] = $value->institute_students->count();

            $data['total_exam'] = InstituteClassBatchExam::where('institute_class_batch_id', $value->id)->count();
        }
        $data['total_batch'] = $teacher_batchs->count();

        $data['total_attendences'] = Attendence::where('table', 'users')->where('table_id', auth()->user()->id)->count();

        // $data['avg_mark'] = InstituteClassBatchExamMark::where('user_id', auth()->user()->id)->avg('mark');
        $data['news'] = $news;
        $data['notice'] = $Notice;
        $data = (object) $data;

        return response()->json($data);
    }

    // public function student_dashboard_stats() : object {
        
    // }
}
