<?php

namespace Database\Seeders\Institute;

use App\Models\Accounts\AccountCategory;
use App\Models\Accounts\BranchAccount;
use App\Models\Accounts\BranchAccountLog;
use App\Models\Institute\InstituteStudentPayment;
use Carbon\Carbon;
use Database\Seeders\Accounts\AccountLogSeeder;
use Illuminate\Database\Seeder;

class StudentPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InstituteStudentPayment::truncate();
        $account_category = AccountCategory::where('title', "monthly fee")->first();
        $account = BranchAccount::where('title', 'cash')->first();

        $account_log = new BranchAccountLog();
        $account_log->branch_id = 2;
        $account_log->account_category_id = $account_category->id;
        $account_log->account_id = $account->id;
        $account_log->amount = 550;
        $account_log->type = "credit";
        $account_log->is_income = 1;
        $account_log->is_expense = 0;
        $account_log->save();

        $student_payment = new InstituteStudentPayment();
        $student_payment->user_id = 4;
        $student_payment->branch_id = 2;
        $student_payment->account_log_id = $account_log->id;
        $student_payment->amount = 550;
        $student_payment->date = Carbon::now()->subDays(1);
        $student_payment->institute_student_id = 1;
        $student_payment->save();
        

        $account_log = new BranchAccountLog();
        $account_log->branch_id = 2;
        $account_log->account_category_id = $account_category->id;
        $account_log->account_id = $account->id;
        $account_log->amount = 450;
        $account_log->type = "credit";
        $account_log->is_income = 1;
        $account_log->is_expense = 0;
        $account_log->save();

        $student_payment = new InstituteStudentPayment();
        $student_payment->user_id = 4;
        $student_payment->branch_id = 2;
        $student_payment->account_log_id = $account_log->id;
        $student_payment->amount = 450;
        $student_payment->date = Carbon::now()->subDays(1);
        $student_payment->institute_student_id = 1;
        $student_payment->save();

        
        $account_log = new BranchAccountLog();
        $account_log->branch_id = 2;
        $account_log->account_category_id = $account_category->id;
        $account_log->account_id = $account->id;
        $account_log->amount = 1050;
        $account_log->type = "credit";
        $account_log->is_income = 1;
        $account_log->is_expense = 0;
        $account_log->save();

        $student_payment = new InstituteStudentPayment();
        $student_payment->user_id = 6;
        $student_payment->branch_id = 2;
        $student_payment->account_log_id = $account_log->id;
        $student_payment->amount = 1050;
        $student_payment->date = Carbon::now()->subDays(3);
        $student_payment->institute_student_id = 3;
        $student_payment->save();


        $account_log = new BranchAccountLog();
        $account_log->branch_id = 2;
        $account_log->account_category_id = $account_category->id;
        $account_log->account_id = $account->id;
        $account_log->amount = 950;
        $account_log->type = "credit";
        $account_log->is_income = 1;
        $account_log->is_expense = 0;
        $account_log->save();

        $student_payment = new InstituteStudentPayment();
        $student_payment->user_id = 7;
        $student_payment->branch_id = 2;
        $student_payment->account_log_id = $account_log->id;
        $student_payment->amount = 950;
        $student_payment->date = Carbon::now()->subDays(4);
        $student_payment->institute_student_id = 4;
        $student_payment->save();

        $account_log = new BranchAccountLog();
        $account_log->branch_id = 2;
        $account_log->account_category_id = $account_category->id;
        $account_log->account_id = $account->id;
        $account_log->amount = $student_payment->amount;
        $account_log->type = "credit";
        $account_log->is_income = 1;
        $account_log->is_expense = 0;
        $account_log->save();

        $student_payment = new InstituteStudentPayment();
        $student_payment->user_id = 8;
        $student_payment->branch_id = 2;
        $student_payment->account_log_id = $account_log->id;
        $student_payment->amount = 950;
        $student_payment->date = Carbon::now()->subDays(5);
        $student_payment->institute_student_id = 5;
        $student_payment->save();
    }
}
