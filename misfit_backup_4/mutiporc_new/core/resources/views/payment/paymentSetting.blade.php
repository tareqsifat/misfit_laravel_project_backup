@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Payment Settings</div>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-common-body">
                    <div class="row">
                        <div class="tab-content" id="pills-tabContent">
                            {{-- Bank Account Start --}}
                            <div class="main-heading-container">
                                <div class="common-title">Payment Settings</div>
                            </div>
                            <div class="tab-pane fade  show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="row mb-4">
                                    <div class="col-lg-12">

                                        <div class="card-common-body">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label>Site Global Currencys</label>
                                                    <select name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title">
                                                        <option value="DBD">DBD ( DBD )</option>
                                                        <option value="USD" selected="">USD ( $ )</option>
                                                        <option value="EUR">EUR ( € )</option>
                                                        <option value="INR">INR ( ₹ )</option>
                                                        <option value="IDR">IDR ( Rp )</option>
                                                        <option value="AUD">AUD ( A$ )</option>
                                                        <option value="SGD">SGD ( S$ )</option>
                                                        <option value="JPY">JPY ( ¥ )</option>
                                                        <option value="GBP">GBP ( £ )</option>
                                                        <option value="MYR">MYR ( RM )</option>
                                                        <option value="PHP">PHP ( ₱ )</option>
                                                        <option value="THB">THB ( ฿ )</option>
                                                        <option value="KRW">KRW ( ₩ )</option>
                                                        <option value="NGN">NGN ( ₦ )</option>
                                                        <option value="GHS">GHS ( GH₵ )</option>
                                                        <option value="BRL">BRL ( R$ )</option>
                                                        <option value="BIF">BIF ( FBu )</option>
                                                        <option value="CAD">CAD ( C$ )</option>
                                                        <option value="CDF">CDF ( FC )</option>
                                                        <option value="CVE">CVE ( Esc )</option>
                                                        <option value="GHP">GHP ( GH₵ )</option>
                                                        <option value="GMD">GMD ( D )</option>
                                                        <option value="GNF">GNF ( FG )</option>
                                                        <option value="KES">KES ( Ksh )</option>
                                                        <option value="LRD">LRD ( L$ )</option>
                                                        <option value="MWK">MWK ( MK )</option>

                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Custom Currency Symbol</label>
                                                    <select name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title">
                                                        <option value="DBD">Left</option>
                                                        <option value="USD" selected="">Right</option>

                                                    </select>
                                                </div>
                                                <div class="form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Yes/No Amount Decimal Mode</label>
                                                </div>
                                                <div class="form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Coupon Apply</label>
                                                </div>
                                                <div class="col-md-6 mt-4 form-group">
                                                    <label>Default Payment Gateway</label>
                                                    <select name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title">
                                                        <option value="manual_payment">Manual Payment</option>
                                                        <option value="mollie">Mollie</option>
                                                        <option value="paytm">Paytm</option>
                                                        <option value="stripe">Stripe</option>
                                                        <option value="razorpay">Razorpay</option>
                                                        <option value="flutterwave">Flutterwave</option>
                                                        <option value="paystack">Paystack</option>
                                                        <option value="midtranse">Midtranse</option>
                                                        <option value="paystack">Paystack</option>
                                                        <option value="marcedopago">Marcedopago</option>
                                                        <option value="instamojo">Instamojo</option>
                                                        <option value="cashfree">Cashfree</option>
                                                        <option value="cinetpay">Cinetpay</option>
                                                        <option value="squareup">Squareup</option>
                                                        <option value="billplz">Billplz</option>
                                                    </select>
                                                    <span></span>
                                                </div>
                                                <div class="col-md-6 mt-4 form-group">
                                                    <label>USD to IDR Exchange Rate</label>
                                                    <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
                                                    <span>enter USD to USD exchange rate. eg: 1 USD = ? IDR</span>
                                                </div>
                                                <div class="col-md-6 mt-4 form-group">
                                                    <label>USD to INR Exchange Rate</label>
                                                    <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
                                                    <span>enter USD to INR exchange rate. eg: 1USD = ? INR</span>
                                                </div>
                                                <div class="col-md-6 form-group mt-4">
                                                    <label>USD to NGN Exchange Rate</label>
                                                    <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
                                                    <span>enter USD to NGN exchange rate. eg: 1USD = ? NGN</span>
                                                </div>
                                                <div class="col-md-6 mt-4 form-group">
                                                    <label>USD to ZAR Exchange Rate</label>
                                                    <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
                                                    <span>enter USD to USD exchange rate. eg: 1 USD = ? ZAR</span>
                                                </div>


                                                <div class="col-md-6 form-group mt-4">
                                                    <label>USD to BRL Exchange Rate</label>
                                                    <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
                                                    <span>enter USD to BRL exchange rate. eg: 1USD = ? BRL</span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>USD to MYR Exchange Rate</label>
                                                    <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
                                                    <span>enter USD to MYR exchange rate. eg: 1USD = ? MYR</span>
                                                </div>
                                                <div class="btnWrapperPrimary">
                                                    <div class="col-6 d-flex form-btns">
                                                        <button type="submit" class="btn btn-primary">Update Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Bank Account End --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>
@endsection