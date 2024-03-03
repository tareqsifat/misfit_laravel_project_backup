@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form action="" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>@lang('Status')</label>
                                    
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="trading_status" role="switch" id="trading_status" @if($trading_settings->trading == 'active') checked @endif>
                                    </div>
                                    
                                    <button type="submit" class="btn btn--primary w-100 h-45">@lang('Update')</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

