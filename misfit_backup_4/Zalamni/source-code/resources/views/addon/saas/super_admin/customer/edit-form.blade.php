<form class="ajax reset" action="{{ route('saas.super_admin.customer_update', $customer->id) }}" method="post"
      data-handler="commonResponseForModal">
    @csrf
    <div class="modal-body zModalTwo-body">
        <div class="d-flex justify-content-between align-items-center pb-30">
            <h4 class="fs-20 fw-500 lh-38 text-1b1c17">{{__('Update New')}}</h4>
            <div class="mClose">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img src="{{asset('assets/images/icon/delete.svg')}}" alt="" /></button>
            </div>
        </div>
        <input type="hidden" name="id" value="{{$customer->id}}">
        <div class="row">
            <div class="col-12">
                <div class="primary-form-group mt-2">
                    <div class="primary-form-group-wrap">
                      <label for="currentPassword" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                      <input type="text" class="primary-form-control" name="name" value="{{$customer->name}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="primary-form-group mt-4">
                    <div class="primary-form-group-wrap">
                      <label for="currentPassword" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                      <input type="email" class="primary-form-control" name="email" value="{{$customer->email}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="primary-form-group my-2 pt-3">
                    <div class="primary-form-group-wrap">
                      <label for="BatchName" class="form-label">{{ __('Status') }} <span class="text-danger">*</span></label>
                      <select class="primary-form-control sf-select-without-search" id="BatchName" name="status">
                        <option {{$customer->status == 1?'selected':''}} value="1">{{ __('Active') }}</option>
                        <option {{$customer->status == 0?'selected':''}} value="0">{{ __('Deactive') }}</option>
                      </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer border-0">
        <button type="submit" class="py-10 px-26 bg-7f56d9 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">{{ __('Update') }}</button>
    </div>
</form>
