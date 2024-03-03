@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Payment Settings</div>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-common-body">
                    <div class="row">
                        <div class="tab-content" id="pills-tabContent">
                            {{-- Bank Account Start --}}
                            <div class="main-heading-container">
                                <div class="common-title">Payment Gateway Settings</div>
                                <div class="common-title mt-2">Bank transfer</div>
                            </div>
                            <div class="tab-pane fade  show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div class="card-common-body">
                                            <div class="row">
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Main Color One</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#FF7465" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Main Color One RGB</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="255, 116, 101" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Main Color Two</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#FF8339" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Main Color Two RBA</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#FFFFFF" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Heading Color</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#12244C" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Heading Color Two</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#516072" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Heading Color RGB</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="81, 96, 114" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Button Color One</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#FF7465" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Button Color Two</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#FF5229" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Scroll Bar Background</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#F0F0F0" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Scrollbar Color</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#c5c5c5" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Background Light Color One</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#F5F9FE" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Background Light Color Two</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#FEF8F3" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Background Dark Color One</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#040A1B" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Background Dark Color Two</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#22253F" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Paragraph Color</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#919191" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Paragraph Color</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#475467" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Paragraph Color</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#D0D5DD" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Paragraph Color</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#344054" style="display: block;width: 50px; height: 50px;">


                                                </div>
                                                <div class="col-md-12 mt-4 form-group">

                                                    <label>Site Stock Color</label>
                                                    <input type="color" name="ecommerce_main_color_one" class="form-control" value="#5AB27E" style="display: block;width: 50px; height: 50px;">


                                                </div>
             
                                                <div class="btnWrapperPrimary">
                                                    <div class="col-6 form-btns">
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>
@endsection