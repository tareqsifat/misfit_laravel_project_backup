@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Price Plan</div>
</div>


<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">Price Plan</div>
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
                                <th>Title</th>
                                <th>Price</th>
                                <th>IsPopular</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($all_plans as $data)
                            <tr>
                             
                                <td>
                                {{$data->id}}
                                </td>
                                <td>
                                {{ $data->getTranslation('title',$lang_slug)}}
                                </td>

                                <td>
                                {{ amount_with_currency_symbol($data->price) }}
                                </td>
                                <td>
                                @if($data->is_popular == 'on')
                                        <span class="badge badge-success">{{__('Yes')}}</span>
                                    @else
                                        <span class="badge badge-dark">{{__('No')}}</span>
                                    @endif
                                </td>
                                <td>
                                {{ \App\Enums\StatusEnums::getText($data->status)  }}
                                </td>
                                <td>
                                @can('wedding-price-plan-edit')
                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#testimonial_item_edit_modal"
                                           class="btn btn-primary btn-xs mb-3 mr-1 testimonial_edit_btn"
                                           data-bs-placement="top"
                                           title="{{__('Edit')}}"
                                           data-id="{{$data->id}}"
                                           data-action="{{route('tenant.admin.wedding.price.plan.update')}}"
                                           data-title="{{$data->getTranslation('title',$default_lang)}}"
                                           data-features="{!! purify_html($data->getTranslation('features',$default_lang)) !!}"
                                           data-not_available_features="{!! purify_html($data->getTranslation('not_available_features',$default_lang)) !!}"
                                           data-price="{{$data->price}}"
                                           data-is_popular="{{$data->is_popular}}"
                                           data-status="{{$data->status}}"
                                        >
                                            <i class="las la-edit"></i>
                                        </a>

                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr> 
                            <th>ID</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>IsPopular</th>
                                <th>Status</th>
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
@can('wedding-price-plan-create')
        <div class="modal fade" id="new_testimonial" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{__('New Plan')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('tenant.admin.wedding.price.plan')}}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="lang" value="{{$default_lang}}">
                            <x-fields.input name="title" label="{{__('Title')}}" />

                            <x-fields.textarea name="features" label="{{__('Features')}}" info="{{__('Separate feature by entering (comma) end of the line')}}" />
                            <x-fields.textarea name="not_available_features" label="{{__('Not Available Features')}}" info="{{__('Separate not available feature by entering (comma) end of the line')}}"/>
                            <x-fields.input type="number" name="price" label="{{__('Price')}}" />
                            <x-fields.switcher name="is_popular" label="{{__('Is Popular')}}" />
                            <x-fields.select name="status" title="{{__('Status')}}">
                                <option value="{{\App\Enums\StatusEnums::PUBLISH}}">{{__('Publish')}}</option>
                                <option value="{{\App\Enums\StatusEnums::DRAFT}}">{{__('Draft')}}</option>
                            </x-fields.select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('wedding-price-plan-edit')
        <div class="modal fade" id="testimonial_item_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{__('Edit Plan Item')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="#" id="testimonial_edit_modal_form" method="post"
                          enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="id" value="" class="plan_id">
                            <input type="hidden" name="lang" value="{{$default_lang}}">

                            <x-fields.input name="title" label="{{__('Title')}}" class="edit_title"/>
                            <x-fields.textarea name="features" label="{{__('Features')}}"  class="edit_features" info="{{__('Separate feature by entering (comma) end of the line')}}"/>
                            <x-fields.textarea name="not_available_features" label="{{__('Not Available Features')}}" class="edit_not_available_features" info="{{__('Separate not available feature by entering (comma) end of the line')}}"/>
                            <x-fields.input type="number" name="price" label="{{__('Price')}}"  class="edit_price"/>
                            <x-fields.switcher name="is_popular" label="{{__('Is Popular')}}" class="edit_is_popular"/>
                            <x-fields.select name="status" title="{{__('Status')}}">
                                <option value="1">{{__('Publish')}}</option>
                                <option value="0">{{__('Draft')}}</option>
                            </x-fields.select>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
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



@endsection