@extends(route_prefix().'admin.admin-master')
@section('content')
{{-- <div class="main-heading-container">
    <div class="common-title">SANKALP CIVIL SERVICES</div>
</div> --}}
{{-- <div class="row mb-4">
    <div class="col-lg-12">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">Generate New Question Paper</div>
            </div>
            <div class="card-common-body">
                <div class="row">
                    <div class="btnWrapperPrimary">
                        <div class="col-12 d-flex form-btns ">
                            <button class="btn-gradient-bg w-120">Start</button>
                            <button class="btn-gradient w-120">Tutorials</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">Dashboard</div>
            </div>
            <div class="card-common-body">
                <div class="row mb-4 total-sale-wraper total-many-wrapper ordersAll">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="total-info-container">
                            <div class="total-info-card">
                                <div class="info-card-detail">
                                    <div class="info-card-price">$30200</div>
                                    <div class="total-info-card-title">All Earning</div>
                                </div>
                                <div class="total-info-card-icon">
                                    <img src="{{global_asset('assets/landlord/admin/imagess/signal.svg')}}">
                                </div>
                            </div>
                            <button type="button">
                                % Change
                                <span class="total-info-card-icon2"><img src="{{global_asset('assets/landlord/admin/imagess/arrow-up.svg')}}"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="total-info-container">
                            <div class="total-info-card">
                                <div class="info-card-detail">
                                    <div class="info-card-price">29+</div>
                                    <div class="total-info-card-title">Page View</div>
                                </div>
                                <div class="total-info-card-icon">
                                    <img src="{{global_asset('assets/landlord/admin/imagess/page.svg')}}">
                                </div>
                            </div>
                            <button type="button">
                                % Change
                                <span class="total-info-card-icon2"><img src="{{global_asset('assets/landlord/admin/imagess/arrow-up.svg')}}"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="total-info-container">
                            <div class="total-info-card">
                                <div class="info-card-detail">
                                    <div class="info-card-price">142</div>
                                    <div class="total-info-card-title">Task Completed</div>
                                </div>
                                <div class="total-info-card-icon">
                                    <img src="{{global_asset('assets/landlord/admin/imagess/task.svg')}}">
                                </div>
                            </div>
                            <button type="button">
                                % Change
                                <span class="total-info-card-icon2"><img src="{{global_asset('assets/landlord/admin/imagess/arrow-up.svg')}}"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="total-info-container">
                            <div class="total-info-card">
                                <div class="info-card-detail">
                                    <div class="info-card-price">50</div>
                                    <div class="total-info-card-title">Download</div>
                                </div>
                                <div class="total-info-card-icon">
                                    <img src="{{global_asset('assets/landlord/admin/imagess/download.svg')}}">
                                </div>
                            </div>
                            <button type="button">
                                % Change
                                <span class="total-info-card-icon2"><img src="{{global_asset('assets/landlord/admin/imagess/arrow-up.svg')}}"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="total-info-container">
                            <div class="total-info-card">
                                <div class="info-card-detail">
                                    <div class="info-card-price">$30200</div>
                                    <div class="total-info-card-title">All Earning</div>
                                </div>
                                <div class="total-info-card-icon">
                                    <img src="{{global_asset('assets/landlord/admin/imagess/signal.svg')}}">
                                </div>
                            </div>
                            <button type="button">
                                % Change
                                <span class="total-info-card-icon2"><img src="{{global_asset('assets/landlord/admin/imagess/arrow-up.svg')}}"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="total-info-container">
                            <div class="total-info-card">
                                <div class="info-card-detail">
                                    <div class="info-card-price">250+</div>
                                    <div class="total-info-card-title">Page View</div>
                                </div>
                                <div class="total-info-card-icon">
                                    <img src="{{global_asset('assets/landlord/admin/imagess/page.svg')}}">
                                </div>
                            </div>
                            <button type="button">
                                % Change
                                <span class="total-info-card-icon2"><img src="{{global_asset('assets/landlord/admin/imagess/arrow-up.svg')}}"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card-common">
            <div class="d-flex align-items-center justify-content-between">
                <div class="card-topbar-inner">
                    <div class="card-topbar-title">Add a Custome Domain</div>
                    <div class="card-topbar-paragraph">Your current domain is ff9809-5.myshopify.com but you can add a custom domain to help customers find your online store</div>
                    <button class="btn-gradient-bg w-120">Add Domain</button>
                </div>
                <div>
                    <img src="{{global_asset('assets/landlord/admin/imagess/domain.svg')}}">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-2 orderSummaryWrapper">
        <div class="col-lg-12 col-xl-6 col-activity">
            <div class="card-common">
                <div class="card-topbar card-topbar-justify-center">
                    <div class="card-topbar-title">Total Sale</div>
                    <ul class="nav nav-pills dbrdTabs" id="pills-Ordertab">
                        <li class="nav-item">
                            <button class="nav-link active" id="pills-Order-Daily-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Order-Daily" type="button">Daily</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-Order-Weekly-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Order-Weekly" type="button">Weekly</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-Order-Monthly-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Order-Monthly" type="button">Monthly</button>
                        </li>
                    </ul>


                </div>
                <div class="card-common-body">
                    <div class="tab-content" id="pills-OrdertabContent">
                        <div class="tab-pane fade show active" id="pills-Order-Daily">
                            <canvas id="OrderDailyChart" style="height: 200px"></canvas>
                        </div>
                        <div class="tab-pane fade" id="pills-Order-Weekly">
                            <canvas id="OrderWeeklyChart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="pills-Order-Monthly">
                            <canvas id="OrderMonthlyChart"></canvas>
                        </div>

                    </div>
                    {{-- <div style="width: 800px;"><canvas id="myChart"></canvas></div> --}}
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-xl-6 col-activity">
            <div class="card-common">
                <div class="card-topbar card-topbar-justify card-topbar-justify-center">
                    <div class="card-topbar-title"> Total Online Store Visiter</div>
                    <ul class="nav nav-pills dbrdTabs" id="pills-Salestab">
                        <li class="nav-item">
                            <button class="nav-link active" id="pills-Sales-Daily-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Sales-Daily" type="button">Daily</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-Sales-Weekly-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Sales-Weekly" type="button">Weekly</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-Sales-Monthly-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Sales-Monthly" type="button">Monthly</button>
                        </li>
                    </ul>
                </div>
                <div class="card-common-body">
                    <div class="tab-content" id="pills-SalestabContent">
                        <div class="tab-pane fade show active" id="pills-Sales-Daily">
                            <canvas id="SalesDailyChart" style="height: 200px"></canvas>
                        </div>
                        <div class="tab-pane fade" id="pills-Sales-Weekly">
                            <canvas id="SalesWeeklyChart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="pills-Sales-Monthly">
                            <canvas id="SalesMonthlyChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-xl-12 col-activity my-4">
            <div class="card-common">
                <div class="card-topbar card-topbar-justify card-topbar-justify-center">
                    <div class="card-topbar-title">Report Customer Rate</div>
                    <ul class="nav nav-pills dbrdTabs" id="pills-Commissiontab">
                        <li class="nav-item">
                            <button class="nav-link active" id="pills-Commission-Daily-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Commission-Daily" type="button">Daily</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-Commission-Weekly-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Commission-Weekly" type="button">Weekly</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-Commission-Monthly-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Commission-Monthly" type="button">Monthly</button>
                        </li>
                    </ul>
                </div>
                <div class="card-common-body">
                    <div class="tab-content" id="pills-CommissiontabContent">
                        <div class="tab-pane fade show active" id="pills-Commission-Daily">
                            <canvas id="CommissionDailyChart" style="height: 200px"></canvas>
                        </div>
                        <div class="tab-pane fade" id="pills-Commission-Weekly">
                            <canvas id="CommissionWeeklyChart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="pills-Commission-Monthly">
                            <canvas id="CommissionMonthlyChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


<div class="row mb-2 SCSummary">
    
</div>




@endsection