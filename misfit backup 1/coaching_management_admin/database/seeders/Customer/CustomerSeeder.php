<?php

namespace Database\Seeders\Customer;

use App\Models\CRM\Customers;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customers::truncate();

        // customer for first branch
        $customer = new Customers();
        $customer->full_name = "Abdullah al jaber";
        $customer->address = "Road no 7, Mirpur 10, 1206, Dhaka";
        $customer->branch_id = 1;
        $customer->save();


        $customer = new Customers();
        $customer->full_name = "Samin al jabir";
        $customer->address = "Road no 7, Mirpur 10, 1205, Dhaka";
        $customer->branch_id = 1;
        $customer->save();


        $customer = new Customers();
        $customer->full_name = "Asma yasir";
        $customer->address = "Road no 7, Mirpur 10, 1204, Dhaka";
        $customer->branch_id = 1;
        $customer->save();

        // customer for second branch
        $customer = new Customers();
        $customer->full_name = "Shefatullah masum";
        $customer->address = "Road no 5, Sector 10, Uttora, Dhaka";
        $customer->branch_id = 2;
        $customer->save();


        $customer = new Customers();
        $customer->full_name = "Lutfur rahman";
        $customer->address = "Road no 6, Sector 7, Uttora, Dhaka";
        $customer->branch_id = 2;
        $customer->save();


        $customer = new Customers();
        $customer->full_name = "Emon ahmed";
        $customer->address = "Road no 6, Sector 5, Uttora, Dhaka";
        $customer->branch_id = 2;
        $customer->save();

        // customer for third branch
        $customer = new Customers();
        $customer->full_name = "Omar faruk";
        $customer->address = "Road no 5, Green road, Farmgate, Dhaka";
        $customer->branch_id = 3;
        $customer->save();


        $customer = new Customers();
        $customer->full_name = "Rakibul Islam";
        $customer->address = "Road no 4, Green road, Farmgate, Dhaka";
        $customer->branch_id = 3;
        $customer->save();


        $customer = new Customers();
        $customer->full_name = "Nakibul islam";
        $customer->address = "Road no 4, Green road, Farmgate, Dhaka";
        $customer->branch_id = 3;
        $customer->save();
    }
}
