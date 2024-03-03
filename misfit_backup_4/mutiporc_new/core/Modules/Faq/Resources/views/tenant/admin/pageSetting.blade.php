@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Page Settings</div>
    <a href="{{ url('/admin/product/list') }}" class="btn btn-primary w-170">Back</a>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <div class="card-topbar-title">Page Settings</div>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Home Page Display</label>
                            <select class="form-control" name="status">
                                <option value="1">Contact</option>
                                <option value="2">About Us</option>
                                <option value="3">Faq</option>
                                <option value="4">Testimonial</option>
                                <option value="5">Video Gallery</option>
                                <option value="6">Team</option>
                                <option value="7">Portfolio</option>
                                <option value="8">Gallery</option>
                                <option value="9">Blog</option>
                                <option value="10">Services</option>
                                <option value="12">Donation</option>
                                <option value="14">Job</option>
                                <option value="16">Event</option>
                                <option value="17">Knowledgebase</option>
                                <option value="20" selected="">Home Page (Ecommerce)</option>
                                <option value="21">Shop</option>
                                <option value="22">Termns &amp; Condition One</option>
                                <option value="23">Terms &amp; Condition Two</option>
                                <option value="24">Privacy Policy One</option>
                                <option value="25">Privacy Policy 2</option>
                                <option value="26">Campaign</option>
                                <option value="27">demo-home</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Shop Page Display</label>
                            <select class="form-control" name="status">
                                <option value="1">Contact</option>
                                <option value="2">About Us</option>
                                <option value="3">Faq</option>
                                <option value="4">Testimonial</option>
                                <option value="5">Video Gallery</option>
                                <option value="6">Team</option>
                                <option value="7">Portfolio</option>
                                <option value="8">Gallery</option>
                                <option value="9">Blog</option>
                                <option value="10">Services</option>
                                <option value="12">Donation</option>
                                <option value="14">Job</option>
                                <option value="16">Event</option>
                                <option value="17">Knowledgebase</option>
                                <option value="20">Home Page (Ecommerce)</option>
                                <option value="21" selected="">Shop</option>
                                <option value="22">Termns &amp; Condition One</option>
                                <option value="23">Terms &amp; Condition Two</option>
                                <option value="24">Privacy Policy One</option>
                                <option value="25">Privacy Policy 2</option>
                                <option value="26">Campaign</option>
                                <option value="27">demo-home</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Donation Page Display</label>
                            <select class="form-control" name="status">
                                <option value="1">Contact</option>
                                <option value="2">About Us</option>
                                <option value="3">Faq</option>
                                <option value="4">Testimonial</option>
                                <option value="5">Video Gallery</option>
                                <option value="6">Team</option>
                                <option value="7">Portfolio</option>
                                <option value="8">Gallery</option>
                                <option value="9">Blog</option>
                                <option value="10">Services</option>
                                <option value="12" selected="">Donation</option>
                                <option value="14">Job</option>
                                <option value="16">Event</option>
                                <option value="17">Knowledgebase</option>
                                <option value="20">Home Page (Ecommerce)</option>
                                <option value="21">Shop</option>
                                <option value="22">Termns &amp; Condition One</option>
                                <option value="23">Terms &amp; Condition Two</option>
                                <option value="24">Privacy Policy One</option>
                                <option value="25">Privacy Policy 2</option>
                                <option value="26">Campaign</option>
                                <option value="27">demo-home</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Event Page Display</label>
                            <select class="form-control" name="status">
                                <option value="1">Contact</option>
                                <option value="2">About Us</option>
                                <option value="3">Faq</option>
                                <option value="4">Testimonial</option>
                                <option value="5">Video Gallery</option>
                                <option value="6">Team</option>
                                <option value="7">Portfolio</option>
                                <option value="8">Gallery</option>
                                <option value="9">Blog</option>
                                <option value="10">Services</option>
                                <option value="12">Donation</option>
                                <option value="14">Job</option>
                                <option value="16" selected="">Event</option>
                                <option value="17">Knowledgebase</option>
                                <option value="20">Home Page (Ecommerce)</option>
                                <option value="21">Shop</option>
                                <option value="22">Termns &amp; Condition One</option>
                                <option value="23">Terms &amp; Condition Two</option>
                                <option value="24">Privacy Policy One</option>
                                <option value="25">Privacy Policy 2</option>
                                <option value="26">Campaign</option>
                                <option value="27">demo-home</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Job Page Display</label>
                            <select class="form-control" name="status">
                                <option value="1">Contact</option>
                                <option value="2">About Us</option>
                                <option value="3">Faq</option>
                                <option value="4">Testimonial</option>
                                <option value="5">Video Gallery</option>
                                <option value="6">Team</option>
                                <option value="7">Portfolio</option>
                                <option value="8">Gallery</option>
                                <option value="9">Blog</option>
                                <option value="10">Services</option>
                                <option value="12">Donation</option>
                                <option value="14" selected="">Job</option>
                                <option value="16">Event</option>
                                <option value="17">Knowledgebase</option>
                                <option value="20">Home Page (Ecommerce)</option>
                                <option value="21">Shop</option>
                                <option value="22">Termns &amp; Condition One</option>
                                <option value="23">Terms &amp; Condition Two</option>
                                <option value="24">Privacy Policy One</option>
                                <option value="25">Privacy Policy 2</option>
                                <option value="26">Campaign</option>
                                <option value="27">demo-home</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Knowladgebase Page Display</label>
                            <select class="form-control" name="status">
                                <option value="1">Contact</option>
                                <option value="2">About Us</option>
                                <option value="3">Faq</option>
                                <option value="4">Testimonial</option>
                                <option value="5">Video Gallery</option>
                                <option value="6">Team</option>
                                <option value="7">Portfolio</option>
                                <option value="8">Gallery</option>
                                <option value="9">Blog</option>
                                <option value="10">Services</option>
                                <option value="12">Donation</option>
                                <option value="14">Job</option>
                                <option value="16">Event</option>
                                <option value="17" selected="">Knowledgebase</option>
                                <option value="20">Home Page (Ecommerce)</option>
                                <option value="21">Shop</option>
                                <option value="22">Termns &amp; Condition One</option>
                                <option value="23">Terms &amp; Condition Two</option>
                                <option value="24">Privacy Policy One</option>
                                <option value="25">Privacy Policy 2</option>
                                <option value="26">Campaign</option>
                                <option value="27">demo-home</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Terms Condition Page Display</label>
                            <select class="form-control" name="status">
                                <option value="21">Shop</option>
                                <option value="22" selected="">Termns &amp; Condition One</option>
                                <option value="23">Terms &amp; Condition Two</option>
                                <option value="24">Privacy Policy One</option>
                                <option value="25">Privacy Policy 2</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Privacy Policy Page Display</label>
                            <select class="form-control" name="status">
                                <option value="21">Shop</option>
                                <option value="22" selected="">Termns &amp; Condition One</option>
                                <option value="23">Terms &amp; Condition Two</option>
                                <option value="24">Privacy Policy One</option>
                                <option value="25">Privacy Policy 2</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group mt-4">
                            <button type="submit" class="btn btn-primary">Update Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- button --}}
</form>
@endsection