<?php

use App\Models\Product;
use App\Models\Review;
use App\Models\StockLedger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Helper {
    //Product Review
    public static function avgReview($product_id)
    {
        $reviews = Review::where('product_id', $product_id)->where('status', 1)->get();
        $total_review = $reviews->sum('rating');
        $no_of_review = $reviews->count();
        return $avg_review = ceil($total_review / $no_of_review);
    }

    // PRODUCT INVOICE NO
    public static function autoInvoiceNoGenereate($model, $ledgerType) {
        // Get Date From Here
        $date   = date("Ymd");
        $user_id = Auth::guard('seller')->user()->id;
        $autoGenerateInvoiceId = $model->where(['ledger_type' => $ledgerType])->latest('id')->first();

        if (!empty($autoGenerateInvoiceId)) {
            // Create User Id and Date Concatenation
            $user_id_date = $user_id.$date;

            // Check Concatenation(User Id & Date) Length
            $user_id_date_length = strlen($user_id_date);

            // Cut Invoice Number From First Digit to the length of User Id & Date Concatenation Length
            $prev_invoice_cut = substr($autoGenerateInvoiceId->invoice_no, 0, $user_id_date_length);

            // Then Check (User Id & Date Concatenation) with ( Prev Invice Cut Section )
            if ($user_id_date == $prev_invoice_cut){

                // If Match get pre_invoice_cut_length
                $prev_invoice_cut_length = strlen($prev_invoice_cut);

                // Then Get The Last Number which increased by adding 1
                $latest_last_no = substr($autoGenerateInvoiceId->invoice_no, $prev_invoice_cut_length);

                //  Then Add 1
                $add = $latest_last_no + 1;
                $invoice_no = $user_id_date.$add;
            }else{
                $invoice_no = $user_id.$date.'1';
            }

        } else {
            $invoice_no = $user_id.$date.'1';
        }
        return $invoice_no;
    }

    // PRODUCT INVOICE NO FOR ADMIN
    public static function autoAdminInvoiceNoGenereate($model, $ledgerType, $user_id) {
        // Get Date From Here
        $date   = date("Ymd");
        $autoGenerateInvoiceId = $model->where(['ledger_type' => $ledgerType])->latest('id')->first();

        if (!empty($autoGenerateInvoiceId)) {
            // Create User Id and Date Concatenation
            $user_id_date = $user_id.$date;

            // Check Concatenation(User Id & Date) Length
            $user_id_date_length = strlen($user_id_date);

            // Cut Invoice Number From First Digit to the length of User Id & Date Concatenation Length
            $prev_invoice_cut = substr($autoGenerateInvoiceId->invoice_no, 0, $user_id_date_length);

            // Then Check (User Id & Date Concatenation) with ( Prev Invice Cut Section )
            if ($user_id_date == $prev_invoice_cut){

                // If Match get pre_invoice_cut_length
                $prev_invoice_cut_length = strlen($prev_invoice_cut);

                // Then Get The Last Number which increased by adding 1
                $latest_last_no = substr($autoGenerateInvoiceId->invoice_no, $prev_invoice_cut_length);

                //  Then Add 1
                $add = $latest_last_no + 1;
                $invoice_no = $user_id_date.$add;
            }else{
                $invoice_no = $user_id.$date.'1';
            }

        } else {
            $invoice_no = $user_id.$date.'1';
        }
        return $invoice_no;
    }

    //User Order
    public static function autoInvoiceNoGenereateBasicUser($model, $ledgerType, $user_id) {
        // Get Date From Here
        $date   = date("Ymd");
        $autoGenerateInvoiceId = $model->where(['ledger_type' => $ledgerType])->latest('id')->first();

        if (!empty($autoGenerateInvoiceId)) {
            // Create User Id and Date Concatenation
            $user_id_date = $user_id.$date;

            // Check Concatenation(User Id & Date) Length
            $user_id_date_length = strlen($user_id_date);

            // Cut Invoice Number From First Digit to the length of User Id & Date Concatenation Length
            $prev_invoice_cut = substr($autoGenerateInvoiceId->invoice_no, 0, $user_id_date_length);

            // Then Check (User Id & Date Concatenation) with ( Prev Invice Cut Section )
            if ($user_id_date == $prev_invoice_cut){

                // If Match get pre_invoice_cut_length
                $prev_invoice_cut_length = strlen($prev_invoice_cut);

                // Then Get The Last Number which increased by adding 1
                $latest_last_no = substr($autoGenerateInvoiceId->invoice_no, $prev_invoice_cut_length);

                //  Then Add 1
                $add = $latest_last_no + 1;
                $invoice_no = $user_id_date.$add;
            }else{
                $invoice_no = $user_id.$date.'1';
            }

        } else {
            $invoice_no = $user_id.$date.'1';
        }
        return $invoice_no;
    }

    //INVOICE LAST DIGIT GENERATE
    public static function autoInvoiceLastDigit(){
        $orders = DB::table('orders')->latest()->first();
        if (isset($orders)){
            $value = $orders->invoice_last_digit + 1;
            $order_id = str_pad($value,5,"0",STR_PAD_LEFT) ."\n";
        }else{
            $order_id = str_pad(1,5,"0",STR_PAD_LEFT) ."\n";
        }
        return $order_id;
    }

    // ORDER ID
    public static function autoOrderIdGenereate()
    {
        $orders = DB::table('orders')->latest()->first();
        if (isset($orders)){
            $value = $orders->invoice_last_digit + 1;
            $order_id = str_pad($value,5,"0",STR_PAD_LEFT) ."\n";
        }else{
            $order_id = str_pad(1,5,"0",STR_PAD_LEFT) ."\n";
        }
        return $order_id;
    }

    public static function autoOrderInvoiceNoGenereate() {
        $orders = DB::table('orders')->latest()->first();
        if (isset($orders)){
            $value = $orders->invoice_last_digit + 1;
            $invoice_no = str_pad($value,11,"0",STR_PAD_LEFT) ."\n";
        }else{
            $invoice_no = str_pad(1,11,"0",STR_PAD_LEFT) ."\n";
        }
        return $invoice_no;
    }

    public static function autoOrderNewInvoiceNoGenereate() {
        $orders = DB::table('orders')->latest()->first();
        if (isset($orders)){
            $value = $orders->invoice_last_digit + 1;
            $invoice_no = str_pad($value,5,"0",STR_PAD_LEFT) ."\n";
        }else{
            $invoice_no = str_pad(1,5,"0",STR_PAD_LEFT) ."\n";
        }
        $data = date("ym");
        return $data.$invoice_no;
    }

    //GET PRODUCT QTY
    public static function productStock($productId) {
        $stockIn = StockLedger::where('product_id', $productId)->where('stock_in', '!=', 0)->get()->pluck('stock_in')->toArray();
        $stockOut = StockLedger::where('product_id', $productId)->where('stock_out', '!=', 0)->get()->pluck('stock_out')->toArray();

        $stockQty = array_sum($stockIn)-array_sum($stockOut);

        return $stockQty;
    }

    public static function lowstockcount() {
        $products = Product::where('status', 1)->select('id')->get();
        $low_stock_count = [];

        foreach ($products as $product) {

            $stockQty = Helper::productStock($product->id);

            if($stockQty <= 3) {
                $low_stock_products[] = array(
                    "id" => $product->id,
                );
            }
        }
        $low_stock_count = count($low_stock_products);

        return $low_stock_count;
    }
}
