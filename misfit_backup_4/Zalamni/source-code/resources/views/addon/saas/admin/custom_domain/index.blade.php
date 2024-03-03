@extends('layouts.app')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <!-- Page content area start -->
    <div class="p-30">
        <div>
            <input type="hidden" id="custom-domain-list-route" value="{{ route('admin.custom_domain.index') }}">
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-16">
                <h4 class="fs-24 fw-500 lh-34 text-black">{{ $title }}</h4>
                <button type="submit" id="add-news"
                        class="py-10 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one"
                        data-bs-toggle="modal" data-bs-target="#add-modal"><i class="fa fa-plus"></i>
                    {{ __('Request New') }}</button>
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

    <!-- Add Modal section start -->
    <div class="modal fade zModalTwo" id="add-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content zModalTwo-content">
                <form class="ajax reset" action="{{ route('admin.custom_domain.store') }}" method="post"
                      data-handler="commonResponseForModal">
                    @csrf
                    <div class="modal-body zModalTwo-body model-lg">
                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center pb-30">
                            <h4 class="fs-20 fw-500 lh-38 text-1b1c17">{{ __('Request New') }}</h4>
                            <div class="mClose">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img
                                        src="{{ asset('assets/images/icon/delete.svg') }}" alt="" /></button>
                            </div>
                        </div>
                        <div class="row rg-25">
                            <div class="col-md-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <p class="fw-500 text-1b1c17">{{ __('Custom Domain Details') }} :-</p>
                                        <div class="pt-2 mb-2">{!! getOption('cname_information') !!}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="old_domain" class="form-label">{{ __('Current Domain') }}</label>
                                        <input type="text" class="primary-form-control" id="old_domain" name="old_domain" value="{{$currentDomain}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="request_domain" class="form-label">{{ __('New Domain') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="primary-form-control" id="request_domain" name="request_domain">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="py-10 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Modal section end -->

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
