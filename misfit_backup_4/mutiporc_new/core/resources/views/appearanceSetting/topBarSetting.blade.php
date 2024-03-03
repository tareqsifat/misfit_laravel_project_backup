@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Topbar Settings</div>
    <a href="{{url('allEvents')}}" class="btn btn-primary w-170">Back</a>
</div>
<form class="forms-sample" method="post" action="{{route(route_prefix().'admin.topbar.settings')}}">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <div class="card-topbar-title">Topbar Settings</div>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Phone</label>
                            <input type="number" name="topbar_phone" value="" class="form-control" placeholder="Title">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input type="email" name="topbar_email" value="" class="form-control" placeholder="Organizer">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Facebook URL</label>
                            <input type="text" name="topbar_facebook_url" value="" class="form-control" placeholder="Facebook URL">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Instagram URL</label>
                            <input type="text" name="topbar_instagram_url" value="" class="form-control" placeholder="Facebook URL">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>LinkeIn URL</label>
                            <input type="text" name="topbar_linkedin_url" value="" class="form-control" placeholder="Facebook URL">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Twitter URL</label>
                            <input type="text" name="topbar_twitter_url" value="" class="form-control" placeholder="Facebook URL">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Youtube URL</label>
                            <input type="text" name="topbar_youtube_url" value="" class="form-control" placeholder="Facebook URL">
                        </div>
                        <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="landlord_frontend_contact_info_show_hide">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Contact Info</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="landlord_frontend_language_show_hide">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Language</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="landlord_frontend_social_info_show_hide">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Social Info</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="landlord_frontend_topbar_show_hide">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Full Topbar</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="tenant_login_show_hide">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Login Topbar</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="tenant_register_show_hide">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Register Topbar</label>
                                                    </div>
                        <div class="btnWrapperPrimary">
        <div class="d-flex form-btns">
            <button type="submit" class="btn btn-primary">Add Service</button>
        </div>
    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        tinymce.init({
        selector: "textarea#myTextarea",
        plugins: "autoresize",
        autoresize_bottom_margin: 20,
        menubar: false,
    });
    });
</script>