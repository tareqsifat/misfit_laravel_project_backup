@extends(route_prefix().'admin.admin-master')
@section('content')

@php
        $default_theme = get_static_option('tenant_default_theme');
    @endphp
<div class="main-heading-container">
    <div class="common-title">Other Settings</div>
</div>
<form action="" method="POST" action="{{route(route_prefix().'admin.other.settings')}}" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">English (USA)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="true">Arabic</button>
                        </li>
                    </ul>
                </div>
                <!-- <div class="btnWrapperPrimary">
                    <div class="col-12 d-flex form-btns">
                        <button type="submit" class="btn btn-primary w-170">Submit</button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</form>
@endsection