<?php

namespace Database\Seeders\Accounts;

use App\Models\Accounts\BranchAccountLog;
use Illuminate\Database\Seeder;

class AccountLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BranchAccountLog::truncate();
        $account_log = new BranchAccountLog();
        $account_log->branch_id = 1;
        $account_log->account_category_id = 1;
        $account_log->account_id = 2;
        $account_log->amount = 15000;
        $account_log->type = "debit";
        $account_log->description = "monthly office rent";
        $account_log->is_income = 0;
        $account_log->is_expense = 1;
        $account_log->save();

        $account_log = new BranchAccountLog();
        $account_log->branch_id = 1;
        $account_log->account_category_id = 2;
        $account_log->account_id = 1;
        $account_log->amount = 1500;
        $account_log->type = "debit";
        $account_log->description = "monthly office current bill";
        $account_log->is_income = 0;
        $account_log->is_expense = 1;
        $account_log->save();

        $account_log = new BranchAccountLog();
        $account_log->branch_id = 2;
        $account_log->account_category_id = 1;
        $account_log->account_id = 5;
        $account_log->amount = 15000;
        $account_log->type = "debit";
        $account_log->description = "monthly office rent";
        $account_log->is_income = 0;
        $account_log->is_expense = 1;
        $account_log->save();

        $account_log = new BranchAccountLog();
        $account_log->branch_id = 2;
        $account_log->account_category_id = 2;
        $account_log->account_id = 5;
        $account_log->amount = 15000;
        $account_log->type = "debit";
        $account_log->description = "monthly office current bill";
        $account_log->is_income = 0;
        $account_log->is_expense = 1;
        $account_log->save();

        $account_log = new BranchAccountLog();
        $account_log->branch_id = 3;
        $account_log->account_category_id = 1;
        $account_log->account_id = 6;
        $account_log->amount = 15000;
        $account_log->type = "debit";
        $account_log->description = "monthly office rent";
        $account_log->is_income = 0;
        $account_log->is_expense = 1;
        $account_log->save();

        $account_log = new BranchAccountLog();
        $account_log->branch_id = 3;
        $account_log->account_category_id = 2;
        $account_log->account_id = 5;
        $account_log->amount = 15000;
        $account_log->type = "debit";
        $account_log->description = "monthly office current bill";
        $account_log->is_income = 0;
        $account_log->is_expense = 1;
        $account_log->save();
    }
}
