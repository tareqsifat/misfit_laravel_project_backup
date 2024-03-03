<?php

namespace App\Http\Controllers\Frontend;

use App\Charts\DailySales;
use App\Charts\hourlyChart;
use App\Charts\MonthlySalesChart;
use App\Http\Controllers\Controller;
use App\Mail\welcome;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CompanyInfo;
use App\Models\Occasion;
use App\Models\Recipient;
use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use App\Models\ShippingCharge;
use App\Models\Subscribe;
use App\Models\Packaging;
use App\Models\Card;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Popup;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Helper;
use Illuminate\Support\Facades\Mail;
class UserController extends Controller
{
    public function index(){

        $title = 'Best online Gift Shop in Bangladesh | Stygen';
        $meta_title = 'Buy gifts online for your loved ones | Stygen.gift';
        $description = 'Order & send gifts online to your friends & family for any occasion. Gifts delivery in Bangladesh. Flower, cake, perfume, chocolate, books home delivery.';
        return view('frontend_old.frontend_master');
    }

    public function user_details(Request $request){

        if(Auth::check()) {
            return response()->json([
                'user'      => Auth::user(),
            ], 200);
        }
        else {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }

    }

    public function get_user_details(Request $request){

        if(Auth::check()) {
            return response()->json(Auth::user());
        }
        else {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }


    }

    public function updateAddress(Request $request){
        $address = $request->address;
        $user_id = Auth::user()->id;
        User::where('id', $user_id)->update(['address' => $address]);
        return response()->json('Success');
    }

    //Landing Company Info
    public function landingCompanyInfo()
    {
        $company_info = CompanyInfo::where('status', 1)->first();
        return response()->json([
            'company_info' => $company_info
        ], 200);
    }

    //Landing Category
    public function getLandingCategories()
    {
        // $landing_categories = Category::where('status', 1)->where('parent_id', 0)->where('approve_category', 1)->take(8)->get();
        $landing_categories = Category::where('status', 1)->where('parent_id', 0)->where('approve_category', 1)->take(8)->get();
        return response()->json([
            'landing_categories' => $landing_categories
        ], 200);
    }

    //Occasions For Landing Page
    public function getAllOccasion(){
        $occasions = Occasion::where('status', 1)->get();
        return response()->json([
            'occasions' => $occasions
        ], 200);
    }
    public function getAllOccasionLanding(){
        $occasions = Occasion::where('showing_landing', 1)->where('status', 1)->take(12)->get();
        return response()->json([
            'occasions' => $occasions
        ], 200);
    }
    public function getAllBrandLanding(){
        $brands = Brand::all();
        return response()->json([
            'brands' => $brands
        ], 200);
    }

    //Recipient For Landing Page
    public function getAllRecipient(){
        $recipients = Recipient::where('status', 1)->get();
        return response()->json([
            'recipients' => $recipients
        ], 200);
    }

    //Product Review
    public function productReview(Request $request)
    {
        $request->validate([
            'rating'                => ['required', 'not_in:0'],
            'review_description'    => 'required'
        ]);

        $review = Review::create([
            'user_id'           => $request->user_id,
            'product_id'        => $request->product_id,
            'description'       => $request->review_description,
            'rating'            => $request->rating,
            'status'            => 1,
            'created_by'        => $request->user_id,
        ]);

        if($review){
            $avg_review = Helper::avgReview($review->product_id);
            Product::where('id', $review->product_id)->update(['average_ratting' => $avg_review]);
        }

        return response()->json('Success');
    }

    public function userSubscribe(Request $request)
    {
        $request->validate([
            'subscribe_email' => 'required | email'
        ]);

        $subscribe = Subscribe::create([
            'subscribe_email' => $request->subscribe_email,
            'status'          => 1
        ]);
        \Mail::to($request->subscribe_email)->later(now()->addMinutes(1440), new welcome());

        // mailchimp user entry start
        $client = new \MailchimpMarketing\ApiClient();

        $client->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us20',
        ]);

        if($request->email != 'null') {
            $sub_email = $request->subscribe_email;
            $response = $client->lists->addListMember("3484b264b0", [
                "email_address" => $sub_email,
                "status" => "subscribed",
                "tags" => ['website-subscriber']
            ]);
        }

        return response()->json('Success');
    }

    public function clear_order()
    {
        $order_count = Order::where('shipping_status_id', "Pending")->count();
        return view('backend.clear_order', compact('order_count'));
    }

    public function clear_order_confirm(Request $request) {
        if($request->password === "Stygen_delete_order_2022@") {
            $delete = Order::where('shipping_status_id', "Pending")->delete();
            return redirect()->route('home');
        }else {
            return redirect()->back()->with("error","password did not match!");
        }
    }
    // public function popup(Request $request) {
    //     $request->validate([
    //         'popup_email' => 'required | email'
    //     ]);

    //     $popup = Popup::create([
    //         'popup_email' => $request->popup_email,
    //         'popup_phone' => $request->popup_phone,
    //         'status'          => 1
    //     ]);
    //     // \Mail::to($request->subscribe_email)->later(now()->addMinutes(1440), new welcome());

    //     // mailchimp user entry start
    //     $client = new \MailchimpMarketing\ApiClient();

    //     $client->setConfig([
    //         'apiKey' => config('services.mailchimp.key'),
    //         'server' => 'us20',
    //     ]);

    //     if(isset($request->popup_email) && $request->popup_email != 'null') {
    //         $sub_email = $request->popup_email;
    //     }

    //     $response = $client->lists->addListMember("3484b264b0", [
    //         "email_address" => $sub_email,
    //         "status" => "subscribed",
    //         "tags" => ['popup-form']
    //     ]);

    //     return response()->json('Success');
    // }

    //Checkout Shipping Charge
    public function checkoutShippingCharge()
    {
        $cart_content = \Cart::getContent();
        $product_id = [];
        foreach($cart_content as $cart){
            array_push($product_id, $cart->id, $cart->price);
        }
        $shippings = ShippingCharge::join('product_shipping_charges','product_shipping_charges.shipping_charge_id','=','shipping_charges.id')
                ->whereIn('product_shipping_charges.product_id', $product_id)
                ->groupBy('shipping_charges.id')
                ->select('shipping_charges.*')
                ->get();
        if($shippings->count() > 0){
            $shippings = $shippings;
        }else{
            $shippings = ShippingCharge::where('status', 1)->get();
        }
        return response()->json([
            'shippings' => $shippings
        ], 200);
    }

    public function getShippingCharge(Request $request)
    {
        $shipping_charge = ShippingCharge::find($request->shipping_id);
        if(isset($shipping_charge)){
            return response()->json($shipping_charge->shipping_charge);
        }else{
            return response()->json(0);
        }
    }
    //Checkout Packaging List
    public function checkout_packaging_list()
    {
        $packaging_lists = Packaging::where('status', 1)->get();
        return response()->json([
            'packaging_lists' => $packaging_lists
        ], 200);
    }

    //Checkout Greetings Card List
    public function checkout_greetings_card()
    {
        $card_lists = Card::where('status', 1)->get();
        return response()->json([
            'card_lists' => $card_lists
        ], 200);
    }

    //OTP LOGIN
    public function loginOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required'
        ]);

        $phone = $request->phone;
        $code = sprintf("%04d", mt_rand(1, 9999));

        $url = "http://sms.smanager.xyz/smsapi";
        $data = [
            "api_key"   => "C200839660cb400d6f8473.19084410",
            "type"      => "text",
            "contacts"  => $phone,
            "senderid"  => "8809612446932",
            "msg"       => "Your phone number verification code is: ".$code." - www.stygen.gift",
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);
        if($response){
            $userInfo = User::where('phone', $phone)->first();
            if(isset($userInfo)){
                $userInfo->update([
                    'phone'         => $phone,
                    'OTP'           => $code,
                ]);
                Auth::loginUsingId($userInfo->id);
            }else{
                $user = User::create([
                    'name'          => NULL,
                    'username'      => NULL,
                    'email'         => NULL,
                    'phone'         => $phone,
                    'address'       => NULL,
                    'OTP'           => $code,
                    'user_verified' => 0,
                    'password'      => Hash::make($phone),
                    'status'        => 1
                ]);
                if($user){
                    Auth::loginUsingId($user->id);
                }
            }
        }
        return $response;
    }

    public function loginOtpConfirm(Request $request)
    {
        $request->validate([
            'pin' => 'required|digits:4'
        ]);

        $pin    = $request->pin;
        $phone  = $request->phone;

        $userVerify = USer::where('phone', $phone)->where('OTP', $pin)->first();
        if(isset($userVerify)){
            $userVerify->update(['user_verified' => 1]);
            $message = 'success';
        }else{
            $message = 'error';
        }
        return response()->json($message);
    }

    public function sitemap()
    {
        $products = Product::select('pro_slug','updated_at')->where('status', 1)->get();

        return response()->view('sitemap', compact('products'))
            ->header('Content-Type', 'text/xml');
    }

    public function blog_sitemap() {
        $blogs = Blog::select('blog_slug','created_at')->where('status', 1)->get();

        return response()->view('frontend.blog-sitemap', compact('blogs'))
            ->header('Content-Type', 'text/xml');
    }


    public function custom_register(Request $request, Coupon $coupon)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['string', 'email', 'max:255'],
            'phone'     => ['required', 'string', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data = $request->all();

        $username = explode(" ", $data['name']);

        $user = User::create([
            'name'          => $data['name'],
            'username'      => $username[0],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
            'address'       => $data['address'],
            'password'      => Hash::make($data['password']),
            'status'        => 1,
            'is_coupon'     => 1
        ]);

        $user->save();
        $user_email = $request->email;

        $code = 'Stygen'.(string)mt_rand(pow(5, 5), pow(5, 6) - 1);

        $coupon->create([
            'code' => $code,
            'discount_type' => 'Fixed',
            'amount' => 200,
            'minimum_spent' => 500,
            'title' => 'campaign coupon',
            'start_date' => Carbon::today(),
            'expire_date' => Carbon::now()->addMonths(3),
            'coupon_type' => 'temp',
            'use_limit' => 1,
            'status' => 1
        ]);

        $user_details = [
            'name' => $request->name,
            'coupon' => $code,
        ];

        \Mail::to($user_email)->later(now()->addMinutes(1), new \App\Mail\TestMail($user_details));
        \Mail::to($user_email)->later(now()->addMinutes(1440), new welcome());

        // mailchimp user entry start
        $client = new \MailchimpMarketing\ApiClient();

        $client->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us20',
        ]);

        if(isset($user_email)) {
            $sub_email = $user_email;
        }
        else {
            $sub_email = "contact.stygen@gmail.com";
        }

        $response = $client->lists->addListMember("3484b264b0", [
            "email_address" => $sub_email,
            "status" => "transactional",
            "tags" => ['shop registration']
        ]);
        // mailchimp end

        return 'success';

    }

    public function claim_gift(Request $request, Coupon $coupon)
    {
        // dd($request->all());
        if($request->useCount > 3) {
            $msg = 'You already used the spinner more than 3 times';
            return response()->json($msg);
        }
        $user_email = Auth::user()->email;
        $amount = $request->couponPrice;

        $code = 'Stygen'.(string)mt_rand(pow(5, 5), pow(5, 6) - 1);

        $coupons = Coupon::where('created_by',Auth::user()->id)->get();
        $coupon_used = Coupon::select('created_by')->distinct()->first();


        $len = isset($coupons) ? count($coupons) : 0;
        // dd($len, $coupon_used, $coupons);

        if($len > 0){
            $msg = 'You have already claimed the coupon';
            // dd($msg, 'from1');
            return response()->json($msg);
        }
        else if($coupon_used->created_by != 0) {
            $msg = 'You have already claimed the coupon';
            // dd($msg, 'from2');
            return response()->json($msg);
        }
        else {
            $coupon->create([
                'code' => $code,
                'discount_type' => 'Percentage',
                'amount' => $amount,
                'minimum_spent' => 50,
                'maximum_spent' => 500,
                'title' => 'spin wheel coupon',
                'start_date' => Carbon::today(),
                'expire_date' => Carbon::now()->addDays(10),
                'coupon_type' => 'temp',
                'use_limit' => 1,
                'status' => 1,
                'created_by' => Auth::user()->id
            ]);
        }

        $user_details = [
            'name' => Auth::user()->name,
            'coupon' => $code,
            'amount' => $amount
        ];

        \Mail::to($user_email)->later(now()->addMinutes(1), new \App\Mail\GiftCoupon($user_details));
        \Mail::to($user_email)->later(now()->addMinutes(1440), new welcome());

        $msg = 'gift claimed, Chack your mail for the gift';
        return  response()->json($msg);
    }

    public function chart(DailySales $chart) {
        return view('backend.dashboard-report-front',['chart' => $chart->build()]);
    }

    public function monthly_chart(MonthlySalesChart $chart) {
        return view('backend.dashboard-report-monthly-front',['chart' => $chart->build()]);
    }

    public function hour_chart(hourlyChart $chart) {
        return view('backend.dashboard-report-hourly-front',['chart' => $chart->build()]);
    }

    public function category_sitemap()
    {
        // $categories = Category::orderBy('id','desc')->where('status', 1)->get();
        $categories = Category::select('cat_slug','updated_at')->where('status', 1)->get();

        return response()->view('category_sitemap', compact('categories'))
            ->header('Content-Type', 'text/xml');
    }


}
