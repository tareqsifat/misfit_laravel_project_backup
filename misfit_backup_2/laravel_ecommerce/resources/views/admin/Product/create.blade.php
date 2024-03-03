@extends('admin.layout.admin')

@section('content')

    
    <div class="content-wrapper">
        <div class="container-fluid">
            @include('admin.includes.brade_cumb',['title'=>'Product Create'])
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Add Product</div>
                            <hr />
                            <form class="insert_form row" method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                                @csrf


                                <div class="preloader"></div>
                                <div class="form-group col-md-6 col-xl-4">
                                    <label for="input-21" class=" col-form-label">Name</label>
                                    @include('admin.Product.components.input',[
                                            'name' => 'product_name',
                                            'type' => 'text'
                                        ])
                                </div>

                                <div class="form-group col-md-6  col-xl-4">
                                    <label for="input-21" class=" col-form-label">Brand</label>
                                    @include('admin.Product.components.select',[
                                        'name' => 'brand_id',
                                        'attributes' => '',
                                        'class' => 'multiple-select',
                                        'collection' => $brands,
                                        'action' =>  route('brand.store'),
                                        'fields' => [
                                            ['name' => 'name', 'type' => 'text'],
                                            ['name' => 'image', 'type' => 'file']
                                        ]  
                                    ])
                                </div>

                                <div class="form-group col-md-6  col-xl-4">
                                    <label for="input-21" class="col-form-label">Main Category</label>
                                    @include('admin.Product.components.select',[
                                        'name' => 'product_main_category_id',
                                        'attributes' => '',
                                        'class' => 'multiple-select',
                                        'collection' => $maincategories,
                                        'action' =>  route('main_category.store'),
                                        'fields' => [
                                            ['name' => 'name', 'type' => 'text'],
                                            ['name' => 'image', 'type' => 'file']
                                        ]
                                    ])
                                </div>

                                <div class="form-group col-md-6  col-xl-4">
                                    <label for="input-21" class="col-form-label">Category</label>
                                    @include('admin.Product.components.select',[
                                        'name' => 'product_category_id',
                                        'attributes' => '',
                                        'class' => 'multiple-select',
                                        'collection' => $categories,
                                        'action' =>  route('category.store'),
                                        'fields' => [
                                            ['name' => 'main_category_id', 'type' => 'select', 'option_route' => route('get_main_category_json')],
                                            ['name' => 'name', 'type' => 'text'],
                                            ['name' => 'icon', 'type' => 'file']
                                        ]
                                    ])
                                </div>

                                <div class="form-group col-md-6  col-xl-4">
                                    <label for="input-21" class="col-form-label">Sub Category</label>
                                    @include('admin.Product.components.select',[
                                        'name' => 'product_sub_category_id',
                                        'attributes' => '',
                                        'class' => 'multiple-select',
                                        'collection' => $sub_categories,
                                        'action' =>  route('sub_Category.store'),
                                        'fields' => [
                                            [
                                                'name' => 'main_category_id', 
                                                'class' =>'component_modal_main_category parent_select',
                                                'type' => 'select', 
                                                'option_route' => route('get_main_category_json'),
                                                'this_field_will_control' => 'component_modal_category',
                                                'this_field_control_route' => route('get_all_category_selected_by_main_category', '')
                                            ],

                                            [
                                                'name' => 'category_id', 
                                                'class' => 'component_modal_category',
                                                'type' => 'select',
                                                'option_route' => '',
                                            ], 
                                            ['name' => 'name', 'type' => 'text'],
                                            ['name' => 'icon', 'type' => 'file'] 
                                        ]
                                    ])
                                </div>

                                <div class="form-group col-md-6  col-xl-4">
                                    <label for="input-21" class="col-form-label">Writer</label>
                                    @include('admin.Product.components.select',[
                                        'name' => 'writer_id',
                                        'attributes' => '',
                                        'class' => 'multiple-select',
                                        'collection' => $writers,
                                        'action' =>  route('writer.store'),
                                        'fields' => [
                                            ['name' => 'name', 'type' => 'text']
                                        ]
                                    ])
                                </div>

                                <div class="form-group col-md-6  col-xl-4">
                                    <label for="input-21" class="col-form-label">Publication</label>
                                    @include('admin.Product.components.select',[
                                        'name' => 'publication_id',
                                        'attributes' => '',
                                        'class' => 'multiple-select',
                                        'collection' => $publications,
                                        'action' =>  route('publication.store'),
                                        'fields' => [
                                            ['name' => 'name', 'type' => 'text']
                                        ]
                                    ])
                                </div>
                                <div class="form-group col-md-6  col-xl-4">
                                    <label for="input-21" class="col-form-label">Color</label>
                                    @include('admin.Product.components.select',[
                                        'name' => 'color_id',
                                        'attributes' => 'multiple',
                                        'class' => 'multiple-select',
                                        'collection' => $colors,
                                        'action' =>  route('color.store'),
                                        'fields' => [
                                            ['name' => 'name', 'type' => 'text']
                                        ]
                                    ])
                                </div>

                                <div class="form-group col-md-6  col-xl-4">
                                    <label for="input-21" class="col-form-label">Size</label>
                                    @include('admin.Product.components.select',[
                                        'name' => 'size_id',
                                        'attributes' => 'multiple',
                                        'class' => 'multiple-select',
                                        'collection' => $sizes,
                                        'action' =>  route('size.store'),
                                        'fields' => [
                                            ['name' => 'name', 'type' => 'text']
                                        ]
                                    ])
                                </div>

                                <div class="form-group col-md-6  col-xl-4">
                                    <label for="input-21" class="col-form-label">Unit</label>
                                    @include('admin.Product.components.select',[
                                        'name' => 'unit_id',
                                        'attributes' => 'multiple',
                                        'class' => 'multiple-select',
                                        'collection' => $units,
                                        'action' =>  route('unit.store'),
                                        'fields' => [
                                            ['name' => 'name', 'type' => 'text']
                                        ]
                                    ])
                                </div>
                                
                                <div class="form-group col-md-6  col-xl-4">
                                    <label for="input-21" class="col-form-label">Vendor</label>
                                    @include('admin.Product.components.select',[
                                        'name' => 'vendor_id',
                                        'attributes' => 'multiple',
                                        'class' => 'multiple-select',
                                        'collection' => $vendors,
                                        'action' =>  route('vendor.store'),
                                        'fields' => [
                                            ['name' => 'name', 'type' => 'text'],
                                            ['name' => 'email', 'type' => 'email'],
                                            ['name' => 'image', 'type' => 'file'],
                                            ['name' => 'address', 'type' => 'textarea']
                                        ]
                                    ])
                                </div>

                                <div class="form-group col-md-6 col-xl-4">
                                    <label for="input-21" class=" col-form-label">Price</label>
                                    @include('admin.Product.components.input',[
                                            'name' => 'price',
                                            'type' => 'text'
                                        ])
                                </div>

                                <div class="form-group col-md-6 col-xl-4">
                                    <label for="input-21" class=" col-form-label">Discount</label>
                                    @include('admin.Product.components.input',[
                                            'name' => 'discount',
                                            'type' => 'text'
                                        ])
                                </div>

                                <div class="form-group col-md-6 col-xl-4">
                                    <label for="input-21" class=" col-form-label">Expiration Date</label>
                                    @include('admin.Product.components.input',[
                                            'name' => 'expiration_date',
                                            'type' => 'date'
                                        ])
                                </div>

                                <div class="form-group col-md-6 col-xl-4">
                                    <label for="input-21" class=" col-form-label">Stock</label>
                                    @include('admin.Product.components.input',[
                                            'name' => 'stock',
                                            'type' => 'number'
                                        ])
                                </div>

                                <div class="form-group col-md-6 col-xl-4">
                                    <label for="input-21" class=" col-form-label">Alert Quantity</label>
                                    @include('admin.Product.components.input',[
                                            'name' => 'alert_quantity',
                                            'type' => 'number'
                                        ])
                                </div>

                                <div class="col-12"></div>
                                <div class="form-group col-md-6 col-xl-6">
                                    <label for="input-21" class=" col-form-label">Description</label>
                                    <div class="">
                                        {{-- <input type="number" class="form-control" id="input-21" placeholder="Alert" /> --}}
                                        <textarea name="description" class="form-control" id="mytextarea1" cols="30" rows="10"></textarea>
                                        <span class="text-danger description"></span>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-xl-6">
                                    <label for="input-21" class=" col-form-label">Features</label>
                                    <div class="">
                                        {{-- <input type="number" class="form-control" id="input-21" placeholder="Alert" /> --}}
                                        <textarea name="features" class="form-control" id="mytextarea2" cols="30" rows="10"></textarea>
                                        <span class="text-danger features"></span>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-xl-6">
                                    <label for="input-21" class=" col-form-label">Thumb Image</label>
                                    @include('admin.Product.components.input',[
                                            'name' => 'thumb_image',
                                            'type' => 'file',
                                            'attr' => ''
                                        ])
                                </div>

                                <div class="form-group col-md-6 col-xl-6">
                                    <label for="input-21" class=" col-form-label">Related Image</label>
                                    @include('admin.Product.components.input',[
                                            'name' => 'related_images',
                                            'type' => 'file',
                                            'attr' => 'multiple'
                                        ])
                                </div>

                                <div class="form-group col-md-6  col-xl-4">
                                    <label for="input-21" class="col-form-label">Status</label>
                                    <div class="">
                                        <select name="status" id="" class="form-control">
                                            <option value="draft">Draft</option>
                                            <option value="active">Active</option>
                                        </select>
                                        <span class="text-danger status"></span>
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label class="col-form-label"></label>
                                    <div class="">
                                        <button type="submit" class="btn btn-white px-5"><i class="icon-lock"></i> Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <!--start overlay-->
            <div class="overlay"></div>
            <!--end overlay-->
        </div>
        <!-- End container-fluid-->
    </div>
    <!--End content-wrapper-->

    @push('ccss')
        <link href="{{ asset('contents/admin') }}/plugins/select2/css/select2.min.css" rel="stylesheet" />
        <link href="{{ asset('contents/admin') }}/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('contents/admin') }}/plugins/summernote/dist/summernote-bs4.css" />
    @endpush

    @push('cjs')
        <script src="/contents/admin/plugins/select2/js/select2.min.js"></script>
        <script src="{{ asset('contents/admin') }}/plugins/summernote/dist/summernote-bs4.min.js"></script>

        <script>
            $(function() {
                $('.multiple-select').select2({
                
            });
            $('#mytextarea1').summernote({
                    height: 400,
                    tabsize: 2
                });
            $('#mytextarea2').summernote({
                    height: 400,
                    tabsize: 2
                });
            });
        </script>
    @endpush

@endsection



