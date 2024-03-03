@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Product</div>
</div>


<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">All Staff</div>
            </div>
            <div class="card-common-body">
                <div class="row">
                    <div class="col-sm-12 lengthFilterCol">

                        <div class="searchFilter">
                            <i class="fa-regular fa-sliders"></i>
                        </div>
                    </div>
                </div>
                <div class="row no-margin filter-trigger" style="display: block;">
                    <div class="col-md-12">
                        
                        <div class="filters-table-wrapper">
                            <div class="filter-heading">Search Filters</div>
                            <div class="filters-table">
                                <div class="main-filters">
                                    <input type="text" class="form-control form-control-filters" placeholder="ID">
                                    <input type="text" class="form-control form-control-filters" placeholder="Number">
                                    <input type="text" class="form-control form-control-filters" placeholder="Inventory">
                                    <select class="form-control form-control-filters" name="country">
                                        <option value="" selected hidden disabled> Status</option>
                                        <option value="Active">Active</option>
                                        <option value="France">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="filters-control">
                                <a href="#!" class="btn btn-transparent clear-filter">Clear Filter</a>
                                <button type="submit" href="#!" class="btn btn-primary">Search</button>
                                <a href="#!" class="btn  btn-transparent btn-tra hide-filter">Hide Filter</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-table-responsive">
                <table id="customers" class="table tableCommon table-striped table-single-line">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Plan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($all_user as $data)
                            <tr>
                            <td>{{$data->id}}</td>
                                                    <td>{{$data->name}} ({{$data->username}})</td>
                                                    <td>
                                                        @php
                                                        $img = get_attachment_image_by_id($data->image,null,true);
                                                        @endphp
                                                        @if (!empty($img))
                                                            <div class="attachment-preview">
                                                                <div class="thumbnail">
                                                                    <div class="centered">
                                                                        <img class="avatar user-thumb" src="{{$img['img_url']}}" alt="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php  $img_url = $img['img_url']; @endphp
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(!empty($data->getRoleNames()))
                                                            @foreach($data->getRoleNames() as $v)
                                                                {{ $v }}
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <x-delete-popover :url="route(route_prefix().'admin.delete.user',$data->id)"/>
                                                        <a href="{{route(route_prefix().'admin.user.edit',$data->id)}}" class="btn btn-lg btn-primary btn-sm mb-3 mr-1 user_edit_btn">
                                                            <i class="las la-edit"></i>
                                                        </a>
                                                        <a href="#"
                                                           data-id="{{$data->id}}"
                                                           data-bs-toggle="modal"
                                                           data-bs-target="#user_change_password_modal"
                                                           class="btn btn-lg btn-info btn-sm mb-3 mr-1 user_change_password_btn"
                                                        >
                                                            {{__("Change Password")}}
                                                        </a>
                                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Plan</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- delete model  -->

<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fa-solid fa-trash-can textRed"> </i>
                </div>
                <h4 class="modal-title w-100">{{ __('messages.Are_you_sure') }} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>{{ __('messages.Do_you_really') }}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.Cancel') }}</button>
                <button type="button" class="btn btn-danger">{{ __('messages.Delete') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="user_change_password_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Change Admin Password')}}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                </div>
                <x-error-msg/>
                <form action="{{route(route_prefix().'admin.user.password.change')}}" id="user_password_change_modal_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="ch_user_id" id="ch_user_id">
                        <div class="form-group">
                            <label for="password">{{__('Password')}}</label>
                            <input type="password" class="form-control" name="password" placeholder="{{__('Enter Password')}}">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{__('Confirm Password')}}</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{__('Confirm Password')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Change Password')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection