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
                        <div class="item-title d-flex flex-wrap justify-content-end">
                            <div class="mb-3">
                                <button class="border-0 fs-15 fw-500 lh-25 py-10 px-26 bg-7f56d9 bd-ra-12"
                                    type="button" id="add">
                                    <i class="fa fa-plus"></i> {{ __('Add Package') }}
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive zTable-responsive">
                            <table class="table zTable" id="packageDataTable">
                                <thead>
                                    <tr>
                                        <th>
                                            <div>{{ __('SL') }}</div>
                                        </th>
                                        <th>
                                            <div>{{ __('Icon') }}</div>
                                        </th>
                                        <th>
                                            <div>{{ __('Name') }}</div>
                                        </th>
                                        <th>
                                            <div class="text-nowrap">{{ __('Monthly Price') }}</div>
                                        </th>
                                        <th>
                                            <div class="text-nowrap">{{ __('Yearly Price') }}</div>
                                        </th>
                                        <th>
                                            <div>{{ __('Status') }}</div>
                                        </th>
                                        <th>
                                            <div class="text-lg-center">{{ __('Action') }}</div>
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

    {{-- modal  --}}
    <div class="modal fade" id="addModal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-20 border-0 pb-0">
                    <h5 class="modal-title fs-18 fw-600 lh-24 text-1b1c17">{{ __('Add Package') }}</h5>
                    <button type="button" class="w-30 h-30 rounded-circle bd-one bd-c-e4e6eb p-0 bg-transparent"
                        data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-times"></i></button>
                </div>
                <form class="ajax reset" action="{{ route('saas.super_admin.packages.store') }}" method="post"
                    data-handler="commonResponseForModal">
                    @csrf
                    <div class="modal-body">
                        <div class="row rg-20">
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="name" class="form-label">{{ __('Name') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" placeholder="{{ __('Name') }}"
                                        class="primary-form-control">
                                </div>
                            </div>
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="description" class="form-label">{{ __('Short Description') }}</label>
                                    <input type="text" name="description" id="description" placeholder="{{ __('Description') }}"
                                        class="primary-form-control">
                                </div>
                            </div>
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="alumni_limit" class="form-label">{{ __('Alumni Limit') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" name="alumni_limit" id="alumni_limit" placeholder="{{__('Alumni Limit')}}" class="form-control primary-form-control w-auto">
                                        <select name="alumni_limit_type" class="form-select primary-form-control w-auto">
                                            <option value="1">{{__('Limited')}}</option>
                                            <option value="2">{{__('Unlimited')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="event_limit" class="form-label">{{ __('Event Limit') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" name="event_limit" id="event_limit" placeholder="{{__('Event Limit')}}" class="form-control primary-form-control w-auto">
                                        <select name="event_limit_type" class="form-select primary-form-control w-auto">
                                            <option value="1">{{__('Limited')}}</option>
                                            <option value="2">{{__('Unlimited')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="primary-form-group">
                                <div class="d-flex form-check ps-0">
                                    <div class="zCheck form-check form-switch">
                                        <input class="form-check-input mt-0" value="1" name="custom_domain"
                                               type="checkbox" id="custom_domain">
                                    </div>
                                    <label class="form-check-label ps-3 d-flex" for="custom_domain">
                                        {{ __('Custom Domain') }}
                                    </label>
                                </div>
                            </div>
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap zImage-upload-details mw-100">
                                    <div class="zImage-inside">
                                        <div class="d-flex pb-12">
                                            <img src="{{ asset('assets/images/icon/upload-img-1.svg') }}" />
                                        </div>
                                        <p class="fs-15 fw-500 lh-16 text-1b1c17">{{ __('Drag & drop files here') }}
                                        </p>
                                    </div>
                                    <label for="zImageUpload" class="form-label">{{ __('Icon') }}
                                        <span class="text-mime-type">(jpeg,png,jpg)</span>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="upload-img-box">
                                        <img src="" />
                                        <input type="file" name="icon" id="flag" accept="image/*"
                                            onchange="previewFile(this)" />
                                    </div>
                                </div>
                            </div>
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label>{{ __('Other Fields') }}</label>
                                    <button type="button"
                                        class="bd-c-e4e6eb bd-one btn btn-info h-30 p-0 w-30 addOtherField"><i
                                            class="fa fa-plus"></i></button>
                                    <hr class="my-2">
                                    <div class="otherFields">
                                    </div>
                                </div>
                            </div>
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="monthly_price" class="form-label">{{ __('Monthly Price') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="monthly_price" id="monthly_price"
                                        placeholder="{{ __('Monthly Price') }}" class="primary-form-control">
                                </div>
                            </div>
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="yearly_price" class="form-label">{{ __('Yearly Price') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="yearly_price" id="yearly_price"
                                        placeholder="{{ __('Yearly Price') }}" class="primary-form-control">
                                </div>
                            </div>
                            <div class="col-4 mt-4">
                                <div class="d-flex form-check ps-0">
                                    <div class="zCheck form-check form-switch">
                                        <input class="form-check-input mt-0" value="1" name="status"
                                            type="checkbox" id="status">
                                    </div>
                                    <label class="form-check-label ps-3 d-flex" for="status">
                                        {{ __('Status') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-4 mt-4">
                                <div class="d-flex form-check ps-0">
                                    <div class="zCheck form-check form-switch">
                                        <input class="form-check-input mt-0" value="1" name="is_default"
                                            type="checkbox" id="is_default">
                                    </div>
                                    <label class="form-check-label ps-3 d-flex" for="is_default">
                                        {{ __('Is Popular') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="submit"
                            class="m-0 fs-15 border-0 fw-500 lh-25 py-10 px-26 bg-7f56d9 bd-ra-12">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal section start -->
    <div class="modal fade" id="edit-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

            </div>
        </div>
    </div>
    <!-- Edit Modal section end -->

    <input type="hidden" id="packageIndexRoute" value="{{ route('saas.super_admin.packages.index') }}">
@endsection

@push('script')
    <script src="{{ asset('super_admin/custom-js/package.js') }}"></script>
@endpush
