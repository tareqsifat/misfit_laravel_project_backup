@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Add New Role</div>
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
                                <div class="common-title mt-2">New Role</div>
                            </div>
                            <div class="tab-pane fade  show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="row mb-4">
                                    
                                    <div class="col-lg-12">
                                    <button class="btn btn-primary">All Roles</button>
                                        <div class="card-common-body">
                                            <div class="row">
                                            <div class="col-md-12 form-group">
                                                
                                                    <label>Name</label>
                                                    <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Enter Name">

                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Form submission 222</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Page list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Page create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Page edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Page delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Price plan list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Price plan create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Price plan edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Price plan delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Package order all order</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Package order pending order</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Package order progress order</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Package order complete order</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Package order success order page</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Package order cancel order page</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Package order order page manage</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Package order order report</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Package order payment logs</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Package order payment report</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Package order delete</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Package order edit</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Testimonial list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Testimonial create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Testimonial edit</label>
                                                </div>
                                                    <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Testimonial delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Brand list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Brand create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Brand edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Brand delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Blog category list</label>
                                                </div>


                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Blog category create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Blog category edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Blog category delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Blog list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Blog create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Blog edit</label>
                                                </div>



                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Blog delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Blog settings</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Blog comments</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Service category list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Service category create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Service category edit</label>
                                                </div>



                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Service category delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Service list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Service create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Service edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Service delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Service settings</label>
                                                </div>



                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Service comments</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Donation list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Donation create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Donation edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Donation delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Event list</label>
                                                </div>



                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Event create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Event edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Event delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Job list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Job create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Job edit</label>
                                                </div>


                                                


                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Job delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Knowledgebase list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Knowledgebase create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Knowledgebase edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Knowledgebase delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Donation activities list</label>
                                                </div>



                                                
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Donation activities create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Donation activities edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Donation activities delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Portfolio list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Portfolio create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Portfolio edit</label>
                                                </div>




                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Portfolio delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Image gallery list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Image gallery create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Image gallery edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Image gallery delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Attrtibute list</label>
                                                </div>




                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Attrtibute create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Attrtibute edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Attrtibute delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Campaign list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Campaign create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Campaign edit</label>
                                                </div>




                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Campaign delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Inventory list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Inventory create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Inventory edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Inventory delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Product list</label>
                                                </div>




                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Product create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Product edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Product delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Country list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Country create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Country edit</label>
                                                </div>





                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Country delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Shipping list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Shipping create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Shipping edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Shipping delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Coupon list</label>
                                                </div>




                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Coupon create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Coupon edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Coupon delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Tax list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Tax create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Tax edit</label>
                                                </div>




                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Tax delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Badge list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Badge create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Badge edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Badge delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Product order</label>
                                                </div>





                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Tax delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Badge list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Badge create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Badge edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Badge delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Product order</label>
                                                </div>




                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Form builder</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Widget builder</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings page settings</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings global navbar settings</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings global footer settings</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings site identity</label>
                                                </div>





                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings basic settings</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings color settings</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings typography settings</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings seo settings</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings payment settings</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings third party script settings</label>
                                                </div>





                                                
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings smtp settings</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings custom css settings</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings custom js settings</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings database upgrade settings</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings cache clear settings</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">General settings license settings</label>
                                                </div>






                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Language list</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Language create</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Language edit</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Language delete</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Menu manage</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Topbar manage</label>
                                                </div>





                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Other settings</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Newsletter list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Newsletter create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Newsletter edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Newsletter delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Support ticket list</label>
                                                </div>





                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Support ticket create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Support ticket edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Support ticket delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Support ticket department list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Support ticket department create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Support ticket department edit</label>
                                                </div>





                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Support ticket department delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment category list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment category create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment category edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment category delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment sub category list</label>
                                                </div>




                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment sub category create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment sub category edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment sub category delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment edit</label>
                                                </div>






                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Sub appointment list</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Sub appointment create</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Sub appointment edit</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Sub appointment delete</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment day type</label>
                                                </div>





                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment days</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment schedule</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment payment log</label>
                                                </div>
                                                <div class="col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment report</label>
                                                </div>
                                                <div class=" col-md-2 form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Appointment settings</label>
                                                </div>
                                                <div class="btnWrapperPrimary">
                                                    <div class="col-12 form-btns">
                                                        <button type="submit" class="btn btn-primary">Update Changes</button>
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