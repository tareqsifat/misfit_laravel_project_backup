@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Create New Page</div>
    <a href="{{url('allEvents')}}" class="btn btn-primary w-170">Back</a>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <div class="card-topbar-title">Create New Page</div>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Title</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Title">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Visibility</label>
                            <select class="form-control" name="status">
                                <option value="0" selected hidden disabled>Every One</option>
                                <option value="1">User Only</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="0" selected hidden disabled>Publish</option>
                                <option value="1">Draft</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="col-md-6 col-lg-12 form-group">
                        <label>Text Editer</label>
                        <div class="form-group">
                            <textarea id="editor"></textarea>
                              {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                     <div class="card-topbar-title">General Info</div> 
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">General Meta Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="true">Facebook Meta</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="pills-withdraw-tab" data-bs-toggle="pill" data-bs-target="#pills-withdraw" type="button" role="tab" aria-controls="pills-withdraw" aria-selected="true">Twitter Meta</button>
                        </li>
                    </ul>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="tab-content" id="pills-tabContent">
                            {{-- Bank Account Start --}}
                            <div class="tab-pane fade  show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="card-common-body">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>Meta Title</label>
                                            <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Title">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Description</label>
                                            <textarea name="summery" class="form-control" id="" cols="5" rows="5" placeholder="Description"></textarea>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <div class="uploadImagesBarInner">
                                                <label>General info image </label>
                                                <br>
                                                <div class="col-md-12 form-group uploadImgWrapper">
                                                    <input type="file" name="icon" class="customefile1" accept="image/*">
                                                    <div class="uploadImgContainer">
                                                        <div class="cameraIcon"><img class="customebrowse1" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                                        <img id="customepreview1" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>     
                            </div>

                            {{-- Bank Account End --}}

                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div class="card-common">
                                            <div class="card-topbar-inner">
                                                <div class="card-topbar-title">Facebook Info</div>
                                            </div>
                                            <div class="card-common-body">
                                                <div class="row">
                                                    <div class="col-md-12 form-group">
                                                        <label>Meta Title</label>
                                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="General info Title">
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>Description</label>
                                                        <textarea name="summery" class="form-control" id="" cols="5" rows="5" placeholder="General info Description"></textarea>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <div class="uploadImagesBarInner">
                                                            <label>General info image </label>
                                                            <br>
                                                            <div class="col-md-12 form-group uploadImgWrapper">
                                                                <input type="file" name="icon" class="promofile1" accept="image/*">
                                                                <div class="uploadImgContainer">
                                                                    <div class="cameraIcon"><img class="promobrowse1" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                                                    <img id="promopreview1" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
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


                            {{-- Withdraw Start--}}
                            <div class="tab-pane fade" id="pills-withdraw" role="tabpanel" aria-labelledby="pills-withdraw-tab">
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div class="card-common">
                                            <div class="card-topbar-inner">
                                                <div class="card-topbar-title">Twitter Info</div>
                                            </div>
                                            <div class="card-common-body">
                                                <div class="row">
                                                    <div class="col-md-12 form-group">
                                                        <label>Meta Title</label>
                                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="General info Title">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Description</label>
                                                        <textarea name="summery" class="form-control" id="" cols="5" rows="5" placeholder="General info Description"></textarea>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <div class="uploadImagesBarInner">
                                                            <label>General info image </label>
                                                            <br>
                                                            <div class="col-md-12 form-group uploadImgWrapper">
                                                                <input type="file" name="icon" class="promofile2" accept="image/*">
                                                                <div class="uploadImgContainer">
                                                                    <div class="cameraIcon"><img class="promobrowse2" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                                                    <img id="promopreview2" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
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
                            {{-- Withdraw End--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="btnWrapperPrimary">
        <div class="col-12 d-flex form-btns">
            <button type="submit" class="btn btn-primary w-170">Submit</button>
        </div>
    </div>
</form>
{{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}

{{-- <script>
  tinymce.init({
    selector: 'textarea#editor',
    skin: 'bootstrap',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
    menubar: false,
  });
</script>
<script>
    tinymce.init({
    selector: 'textarea#editor',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
    menubar: false,
    setup: (editor) => {
        // Apply the focus effect
        editor.on("init", () => {
        editor.getContainer().style.transition = "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out";
          });
        editor.on("focus", () => { (editor.getContainer().style.boxShadow = "0 0 0 .2rem rgba(0, 123, 255, .25)"),
        (editor.getContainer().style.borderColor = "#80bdff");
          });
        editor.on("blur", () => {
        (editor.getContainer().style.boxShadow = ""),
        (editor.getContainer().style.borderColor = "");
         });
       },
    });
  </script> --}}
  
  {{-- <script>
    tinymce.init({
      selector: 'textarea#editor',
      skin: 'bootstrap', //The TinyMCE Bootstrap skin
      plugins: 'lists, link, image, media',
                           
    });
  </script> --}}
  


@endsection