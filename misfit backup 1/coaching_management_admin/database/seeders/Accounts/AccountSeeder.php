<?php

namespace Database\Seeders\Accounts;

use App\Models\Accounts\AccountDetails;
use App\Models\Accounts\AccountCategory;
use App\Models\Accounts\BranchAccount;
use App\Models\Accounts\BranchAccountLog;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BranchAccount::truncate();
        AccountCategory::truncate();
        BranchAccountLog::truncate();

        $categories = [
            // assets
            "Checking",
            "Savings",
            "purchase",
            "Accounts Receivable",
            "Inventory",
            "Prepaid Expenses",
            "monthly fee",

            // fixed assets
            "Equipment",
            "Land",
            "Buildings",
            "Furniture",
            "Vehicles",

            "Other long-term assets",
            "Intellectual property",
            "Goodwill",
            "Long-term investments",

            // liabilites
            "Accounts Payable",
            "Sales Tax Payable",
            "Income Tax Payable",
            "Wages Payable",
            "Unearned Revenue",
            "Long-term debt",

            // equity
            "Owners Capital",
            "Withdrawals",
            "Revenue",

            // revenue
            "Sales Revenue",
            "Service Revenue",

            // expense
            "Salaries and Wages",
            "Rent",
            "Insurance",
            "Taxes",
            "Other expense"
        ];

        foreach ($categories as $category) {
            $account_category = new AccountCategory();
            $account_category->title = $category;
            $account_category->description = "Category description";
            $account_category->save();
        }

        /** 
         * Main 3 accounts
         * 
         * 1. Bank account
         * 2. Bkash account
         * 3. Cash account
         * 
         * this 3 accounts are same for every branch, the details will be different from account to account
         *  **/
        // Account
        $branch_account = new BranchAccount();
        $branch_account->title = "Bank account";
        $branch_account->description = "Bank account of the admin";
        $branch_account->save();

        $branch_account = new BranchAccount();
        $branch_account->title = "Bank account";
        $branch_account->description = "Bank account of branch admin";
        $branch_account->branch_id = 2;
        $branch_account->save();

        // Account
        $branch_account = new BranchAccount();
        $branch_account->title = "Bkash";
        $branch_account->description = "bkash merchant account of admin";
        $branch_account->save();

        $branch_account = new BranchAccount();
        $branch_account->title = "Bkash";
        $branch_account->description = "bkash merchant account of branch admin";
        $branch_account->branch_id = 2;
        $branch_account->save();

        // Account
        $branch_account = new BranchAccount();
        $branch_account->title = "cash";
        $branch_account->description = "cash account of admin";
        $branch_account->is_cash = 1;
        $branch_account->save();

        $branch_account = new BranchAccount();
        $branch_account->title = "cash";
        $branch_account->description = "cash account of branch admin";
        $branch_account->branch_id = 2;
        $branch_account->is_cash = 1;
        $branch_account->save();

        // Account Details for account 1
        $branch_account_details = new AccountDetails();
        $branch_account_details->branch_id = 1;
        $branch_account_details->account_id = 1;
        $branch_account_details->account_no = "CITY2015851";
        $branch_account_details->account_mobile_no = "01757867854";
        $branch_account_details->account_email = "farmgate_branch@gmail.com";
        $branch_account_details->save();

        // Account Details for account 1
        $branch_account_details = new AccountDetails();
        $branch_account_details->branch_id = 2;
        $branch_account_details->account_id = 1;
        $branch_account_details->account_no = "ISLAMI2155514";
        $branch_account_details->account_mobile_no = "017578678456";
        $branch_account_details->account_email = "mirpur_branch@gmail.com";
        $branch_account_details->save();

        // Account Details for account 1
        $branch_account_details = new AccountDetails();
        $branch_account_details->branch_id = 3;
        $branch_account_details->account_id = 1;
        $branch_account_details->account_no = "EXIMI2155514";
        $branch_account_details->account_mobile_no = "017578678489";
        $branch_account_details->account_email = "uttara_branch@gmail.com";
        $branch_account_details->save();


        // Account Details for account 2
        $branch_account_details = new AccountDetails();
        $branch_account_details->branch_id = 1;
        $branch_account_details->account_id = 2;
        $branch_account_details->account_mobile_no = "01757867854";
        $branch_account_details->account_email = "farmgate_branch@gmail.com";
        $branch_account_details->save();

        // Account Details for account 2
        $branch_account_details = new AccountDetails();
        $branch_account_details->branch_id = 2;
        $branch_account_details->account_id = 2;
        $branch_account_details->account_mobile_no = "017578678456";
        $branch_account_details->account_email = "mirpur_branch@gmail.com";
        $branch_account_details->save();

        // Account Details for account 2
        $branch_account_details = new AccountDetails();
        $branch_account_details->branch_id = 3;
        $branch_account_details->account_id = 2;
        $branch_account_details->account_mobile_no = "017578678489";
        $branch_account_details->account_email = "uttara_branch@gmail.com";
        $branch_account_details->save();


        // Account Details for account 3
        $branch_account_details = new AccountDetails();
        $branch_account_details->branch_id = 1;
        $branch_account_details->account_id = 3;
        $branch_account_details->account_email = "farmgate_branch@gmail.com";
        $branch_account_details->save();

        // Account Details for account 3
        $branch_account_details = new AccountDetails();
        $branch_account_details->branch_id = 2;
        $branch_account_details->account_id = 3;
        $branch_account_details->account_email = "mirpur_branch@gmail.com";
        $branch_account_details->save();

        // Account Details for account 3
        $branch_account_details = new AccountDetails();
        $branch_account_details->branch_id = 3;
        $branch_account_details->account_id = 3;
        $branch_account_details->account_email = "uttara_branch@gmail.com";
        $branch_account_details->save();


        $this->call([
            AccountLogSeeder::class,
        ]);
    }
}
