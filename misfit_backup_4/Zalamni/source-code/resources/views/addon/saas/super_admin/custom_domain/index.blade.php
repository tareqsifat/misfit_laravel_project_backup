@extends('super_admin.layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <!-- Page content area start -->
    <div class="p-30">
        <div>
            <input type="hidden" id="custom-domain-list-route" value="{{ route('saas.super_admin.custom_domain.index') }}">
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-16">
                <h4 class="fs-24 fw-500 lh-34 text-black">{{ $title }}</h4>
            </div>
            <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                <!-- Table -->
                <div class="table-responsive zTable-responsive">
                    <table class="table zTable" id="customDomainDataTable">
                        <thead>
                        <tr>
                            <th scope="col">
                                <div>{{ __('Old Domain') }}</div>
                            </th>
                            <th scope="col">
                                <div>{{ __('Requested Domain') }}</div>
                            </th>
                            <th scope="col">
                                <div>{{ __('Status') }}</div>
                            </th>
                            <th class="w-110 text-center" scope="col">
                                <div>{{ __('Action') }}</div>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- Page content area end -->

    <!-- Edit Modal section start -->
    <div class="modal fade zModalTwo" id="edit-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content zModalTwo-content">

            </div>
        </div>
    </div>
    <!-- Edit Modal section end -->
@endsection

@push('script')
    <script src="{{ asset('admin/js/custom_domain_request.js') }}"></script>
@endpush
