<form class="ajax reset" action="{{ route('saas.super_admin.custom_domain.update', $customDomain->id) }}" method="post"
      data-handler="commonResponseForModal">
    @csrf
    <div class="modal-body zModalTwo-body model-lg">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center pb-30">
            <h4 class="fs-20 fw-500 lh-38 text-1b1c17">{{ __('Update Request') }}</h4>
            <div class="mClose">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{ asset('assets/images/icon/delete.svg') }}" alt=""/></button>
            </div>
        </div>
        <div class="row rg-25">
            <div class="col-md-12">
                <div class="primary-form-group">
                    <div class="primary-form-group-wrap">
                        <label for="old_domain" class="form-label">{{ __('Current Domain') }}</label>
                        <input type="text" class="primary-form-control" id="old_domain" name="old_domain" value="{{$customDomain->old_domain}}" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="primary-form-group">
                    <div class="primary-form-group-wrap">
                        <label for="request_domain" class="form-label">{{ __('New Domain') }} <span class="text-danger">*</span></label>
                        <input type="text" class="primary-form-control" id="request_domain" value="{{$customDomain->request_domain}}" name="request_domain">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="primary-form-group">
                    <div class="primary-form-group-wrap">
                        <label for="status" class="form-label">{{ __('Status') }} <span class="text-danger">*</span></label>
                        <select class="primary-form-control sf-select-without-search" id="status" name="status">
                            <option {{$customDomain->status == STATUS_ACTIVE ? 'selected':''}} value="{{STATUS_ACTIVE}}">{{ __('Approved') }}</option>
                            <option {{$customDomain->status == STATUS_PENDING ? 'selected':''}} value="{{STATUS_PENDING}}">{{ __('Pending') }}</option>
                            <option {{$customDomain->status == STATUS_REJECT ? 'selected':''}} value="{{STATUS_REJECT}}">{{ __('Reject') }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="py-10 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">{{ __('Update') }}</button>
    </div>
</form>
