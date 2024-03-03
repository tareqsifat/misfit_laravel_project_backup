@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Job Application Payment Report</div>
    <a href="{{ url('/admin/product/list') }}" class="btn btn-primary w-170">Back</a>
</div>
<form action="{{route('tenant.admin.job.payment.logs.report')}}" method="get" enctype="multipart/form-data" id="report_generate_form">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <div class="card-topbar-title">Job Application Payment Report</div>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="col-md-2 form-group">
                        <label for="start_date">{{__('Start Date')}}</label>
                                        <input type="date" name="start_date" value="{{$start_date}}" class="form-control">
                        </div>
                        <div class="col-md-2 form-group">
                        <label for="end_date">{{__('End Date')}}</label>
                                        <input type="date" name="end_date" value="{{$end_date}}" class="form-control">
                        </div>
                        <div class="col-md-2 form-group">
                        <label for="payment_status">{{__('Payment Status')}}</label>
                                        <select name="status" id="order_status" class="form-control">
                                            <option value="">{{__('All')}}</option>
                                            <option @if( $payment_status == 0) selected @endif value="0">{{__('Pending')}}</option>
                                            <option @if( $payment_status ==  1) selected @endif value="1">{{__('Complete')}}</option>
                                        </select>
                        </div>
                        <div class="col-md-2 form-group">
                        <label for="items">{{__('Items')}}</label>
                                        <select name="items" id="items" class="form-control">
                                            <option @if( $items == '10') selected @endif value="10">{{__('10')}}</option>
                                            <option @if( $items == '20') selected @endif value="20">{{__('20')}}</option>
                                            <option @if( $items == '50') selected @endif value="50">{{__('50')}}</option>
                                        </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>

                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- button  --}}
</form>
@endsection