@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Add New Staff</div>
    <a href="{{ url('/admin/product/list') }}" class="btn btn-primary w-170">Back</a>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <div class="card-topbar-title">General Infomation</div>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                        <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control"  id="name" name="name" placeholder="{{__('Enter name')}}">
                        </div>
                        <button type="button" class="btn btn-xs mb-4 btn-outline-dark checked_all">{{__('Check All')}}</button>
                        <div class="col-md-6 form-group">
                        <label for="username">{{__('Username')}}</label>
                                <input type="text" class="form-control"  id="username" name="username" placeholder="{{__('Username')}}">
                                <small class="text text-danger">{{__('Remember this username, user will login using this username')}}</small>
                        </div>
                        <div class="col-md-6 form-group">
                        <label for="email">{{__('Mobile')}}</label>
                                <input type="text" class="form-control"  id="mobile" name="mobile" placeholder="{{__('Mobile')}}">
                        </div>
                        <div class="col-md-6 form-group">
                        <label for="email">{{__('Email')}}</label>
                                <input type="text" class="form-control"  id="email" name="email" placeholder="{{__('Email')}}">
                        </div>
                        <div class="col-md-6 form-group">
                        <label for="password">{{__('Password')}}</label>
                                <input type="password" class="form-control"  id="password" name="password" placeholder="{{__('Password')}}">

                        </div>
                        <div class="col-md-6 form-group">
                        <label for="password_confirmation">{{__('Password Confirm')}}</label>
                                <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" placeholder="{{__('Password Confirmation')}}">

                        </div>
                        <div class="col-md-6 form-group">
                        <label for="role">{{'Role'}}</label>
                                <select name="role" class="form-control">
                                    <option value="">{{__('Select Role')}}</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role}}">{{$role}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <br>
                        <div class="col-md-12 form-group uploadImgWrapper">
                        <label for="site_favicon">{{__('Image')}}</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $image = get_attachment_image_by_id(get_static_option('image'),null,true);
                                            $image_btn_label = __( 'Upload Image');
                                        @endphp
                                        @if (!empty($image))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{$image['img_url']}}" alt="" style="width:100px;height:100px;">
                                                    </div>
                                                </div>
                                            </div>
                                            @php  $image_btn_label = __('Change Image'); @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" id="image" name="image" value="{{get_static_option('image')}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__($image_btn_label)}}
                                    </button>
                                </div>
                                <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                        </div>
                        <div class="col-md-12 form-group mt-4">
                            <button type="submit" class="btn btn-primary w-170">Add New Staff</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- button  --}}
</form>
@endsection