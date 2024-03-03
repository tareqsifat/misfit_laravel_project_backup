@extends('super_admin.layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <div class="p-30">
        <div class="">
            <h4 class="fs-24 fw-500 lh-34 text-black pb-16">{{ __($title) }}</h4>
            <div class="row bd-c-ebedf0 bd-half bd-ra-25 bg-white h-100 p-30">
                <div class="col-lg-12">
                    <div class="customers__area bg-style mb-30">

                        <div class="table-responsive zTable-responsive">
                            <table class="table zTable" id="contactDataTable">
                                <thead>
                                    <tr>
                                        <th>
                                            <div>{{ __('Name') }}</div>
                                        </th>
                                        <th>
                                            <div>{{ __('Email') }}</div>
                                        </th>
                                        <th>
                                            <div>{{ __('Message') }}</div>
                                        </th>
                                        <th>
                                            <div>{{ __('Issue') }}</div>
                                        </th>
                                        <th>
                                            <div>{{ __('Phone') }}</div>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" id="contactDataTableRoute" value="{{ route('saas.super_admin.contact-list') }}">
@endsection

@push('script')
    <script src="{{ asset('super_admin/custom-js/contact-us.js') }}"></script>
@endpush
