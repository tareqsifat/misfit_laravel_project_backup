@extends('master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Add New Services</div>
    <a href="{{url('allEvents')}}" class="btn btn-primary w-170">Back</a>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <div class="card-topbar-title">New Services</div>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Title</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Title">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Slug</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Organizer">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Description</label>
                            <textarea id="myTextarea" name="content"></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Category</label>
                            <select class="form-control" name="status">
                                <option value="0" selected hidden disabled>Select an Option</option>
                                <option value="1">All Products</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tags</label>
                            <input type="text" name="product_name" value="" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="1">Publish</option>
                                <option value="2">Draft</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="uploadImagesBarInner">
                                <label>Image</label>
                                <br>
                                <div class="col-md-12 form-group uploadImgWrapper">
                                    <input type="file" name="icon" class="foodfile1" accept="image/*">
                                    <div class="uploadImgContainer">
                                        <div class="cameraIcon"><img class="foodbrowse1" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                        <img id="foodpreview1" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
                                    </div>
                                </div>
                            </div>
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
       
    $(document).ready(function() {
        $('#mySelect').select2();
        $('#varient').select2();
        $('#headFamily').select2();
        $('#headVarient').select2();
        // const lineNumbers = document.getElementById("line-numbers");
        // const cssEditor = document.getElementById("css-editor");
        // const output = document.getElementById("output");

        // cssEditor.addEventListener("input", function () {
        //     const cssCode = cssEditor.value;
        //     output.style.cssText = cssCode;

        //     // Update line numbers
        //     const lines = cssCode.split("\n").length;
        //     lineNumbers.innerHTML = Array.from({ length: lines }, (_, i) => i + 1).join("<br>");
        // });


        // const lineNumbers1 = document.getElementById("line-numbers1");
        // const jsEditor = document.getElementById("js-editor");
        // const output1 = document.getElementById("output1");

        // jsEditor.addEventListener("input", function () {
        //     const jsCode = jsEditor.value;

        //     // Display line numbers
        //     const lines = jsCode.split("\n").length;
        //     lineNumbers1.innerHTML = Array.from({ length: lines }, (_, i) => i + 1).join("<br>");

        //     // Execute the JavaScript code and display the output
        //     try {
        //         output1.innerHTML = eval(jsCode);
        //     } catch (error) {
        //         output1.innerHTML = "Error: " + error.message;
        //     }
        // });
        tinymce.init({
            selector: 'textarea#myTextarea',
            plugins: 'lists link image',
            toolbar: 'undo redo | formatselect | bold italic | bullist numlist outdent indent | link image',
        });
        
    });
    
</script>
<script type="text/javascript">
        
        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll('.sidebar-nav .nav-link').forEach(function(element) {

                element.addEventListener('click', function(e) {

                    let nextEl = element.nextElementSibling;
                    let parentEl = element.parentElement;

                    if (nextEl) {
                        e.preventDefault();
                        let mycollapse = new bootstrap.Collapse(nextEl);

                        if (nextEl.classList.contains('show')) {
                            mycollapse.hide();
                        } else {
                            mycollapse.show();
                            // find other submenus with class=show
                            var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                            // if it exists, then close all of them
                            if (opened_submenu) {
                                new bootstrap.Collapse(opened_submenu);
                            }

                        }
                    }

                });
            })

        });
        // DOMContentLoaded  end
    </script>