@extends('website.layouts.app')
@section('content')
    <section class="bread_cumb_section">
        @isset($category)
            <div class="container">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home" title="Home"></i></a>
                    </li>
                    @if($category->parent)
                    <li>
                        <a href="/{{$category->parent->url}}">
                            <span>{{$category->parent->name}}</span>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="/{{$category->url}}" onclick="event.preventDefault();">
                            <span>{{$category->name}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endisset
    </section>

    <section>
        <div class="container">
            @if ($category->header_description)
                <div class="category_page_top">
                    <div class="description">
                        {!! $category->header_description !!}
                    </div>
                </div>
            @endif

            <div class="child_list" id="categories_and_brands">
                @foreach($category->child as $child)
                    @php
                        $data = [
                            "id" => $child->id,
                            "category_name" => str_replace(' ', '-', strtolower($child->name))
                        ];
                    @endphp
                    <a href="{{ url($child->url) }}">{{$child->name}}</a>
                @endforeach
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="product_list">
                <link rel="stylesheet" href="{{ asset('contents/website/plugins/range/range.css') }}">
                <script src="{{ asset('contents/website/plugins/range/range.js') }}"></script>
                <script src="/contents/frontend/assets/js/plugins/debounce.js"></script>

                <div class="filter_card_list" id="filter_card_list">
                    <div class="close_filter" onclick="filter_card_list.classList.toggle('active');">
                        <i class="fa fa-close"></i>
                    </div>
                    @if ($max_product_price)
                        <div class="mb-3 bg-white filter_card">
                            <div class="card-header bg-white">
                                <b>
                                    Price Range
                                </b>
                            </div>
                            <div class="p-2">
                                <div id="slider"></div>
                                <div class="d-flex justify-content-between mt-3 gap-4">
                                    <input type="number" id="min_input" value="{{request()->min ?? $min_product_price}}" onchange="set_min_max(0,event.target.value)" class="form-control p-1 rounded-0" />
                                    <input type="number" id="max_input" value="{{request()->max ?? $max_product_price}}" onchange="set_min_max(1,event.target.value)" class="form-control p-1 rounded-0" />
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mb-3 bg-white filter_card">
                        <div onclick="stock_list.classList.toggle('d-none')" class="card-header filter_header bg-white d-flex justify-content-between">
                            <b>
                                Availability
                            </b>
                            <b>
                                <i class="fa filter_toggler fa-angle-down"></i>
                            </b>
                        </div>
                        <div class="p-2 d-block filter_list" id="stock_list">
                            <ul>
                                <li>
                                    <label for="is_in_stock">
                                        <input type="radio" {{request()->availability=='is_in_stock'?'checked':''}} onchange="change_availablity()" class="form-check-input me-2" value="1" id="is_in_stock" name="availability">
                                        In Stock Avaiable
                                    </label>
                                </li>
                                <li>
                                    <label for="is_pre_order">
                                        <input type="radio" {{request()->availability=='is_pre_order'?'checked':''}} onchange="change_availablity()" class="form-check-input me-2" value="1" id="is_pre_order" name="availability">
                                        Pre Order
                                    </label>
                                </li>
                                <li>
                                    <label for="is_upcomming">
                                        <input type="radio" {{request()->availability=='is_upcomming'?'checked':''}} onchange="change_availablity()" class="form-check-input me-2" value="1" id="is_upcomming" name="availability">
                                        Upcomming
                                    </label>
                                </li>
                                <li>
                                    <label for="is_tba">
                                        <input type="radio" {{request()->availability=='is_tba'?'checked':''}} onchange="change_availablity()" class="form-check-input me-2" value="1" id="is_tba" name="availability">
                                        To Be Announce
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mb-3 bg-white filter_card">
                        <div onclick="brand_list.classList.toggle('d-none')" class="card-header filter_header bg-white d-flex justify-content-between">
                            <b>
                                Brands
                            </b>
                            <b>
                                <i class="fa filter_toggler fa-angle-down" ></i>
                            </b>
                        </div>
                        <div class="p-2 d-block filter_list" id="brand_list">

                        </div>
                    </div>

                    <div id="varient_list"></div>
                </div>
                <div >
                    <section class="bg-white d-flex flex-wrap gap-2 category_products_heading_wrap">
                        <button onclick="filter_card_list.classList.toggle('active');" class="btn product_filter_toggler rounded-none btn-sm btn-primary px-3">
                            <i class="fa fa-align-left me-2"></i>
                            Filter
                        </button>
                        <h1 class="category_products_heading">
                            {{ isset($brand)? $brand->name: ''}}
                            {{ isset($category)? $category->name: ''}}
                            {{ isset($tag)? $tag->title: ''}}
                        </h1>
                    </section>
                    <div class="product_row category_product_row" id="category_product_list">

                    </div>
                    <div class="col-12 my-4" id="category_products_paginations">

                    </div>
                    @if (strlen($category->description) > 30)
                        <div class="category_page_top">
                            <div class="description">
                                {!! $category->description !!}
                            </div>
                        </div>
                    @endif
                </div>


                <script>
                    var range_value = [];
                    var brands = '';
                    var availability = '';
                    var varients = '';

                    function set_min_max(index=0,value=0){
                        range_value[index] = value;
                        slider.noUiSlider.set([range_value[0], range_value[1]]);
                        debounce(load_data, 1000)();
                    }

                    function change_availablity(){
                        availability = event.target.id;
                        debounce(load_data, 300)();
                    }

                    function change_brand(){
                        brands = [...document.querySelectorAll('input[name="selected_brands"]')];
                        brands = brands.filter(i=>i.checked).map(i=>i.value);
                        debounce(load_data, 300)();
                    }

                    function change_varient(){
                        varients = [...document.querySelectorAll('input[name="selected_varients"]')];
                        varients = varients.filter(i=>i.checked).map(i=>i.value);
                        debounce(load_data, 300)();
                    }

                    function load_data(event){
                        var [min, max] = range_value;
                        var url = new URL(location.href);

                        if(min){
                            min_input.value = min;
                            url.searchParams.set('min',min);
                        }

                        if(max){
                            max_input.value = max;
                            url.searchParams.set('max',max);
                        }

                        if(brands.length){
                            url.searchParams.forEach((i,k)=>k.includes('brands') && url.searchParams.delete(k))
                            brands.forEach((i,index)=>url.searchParams.set(`brands[${index}]`,i));
                        }

                        if(varients.length){
                            url.searchParams.forEach((i,k)=>k.includes('varients') && url.searchParams.delete(k))
                            varients.forEach((i,index)=>url.searchParams.set(`varients[${index}]`,i));
                        }

                        if(availability){
                            url.searchParams.set('availability',availability);
                        }

                        url.searchParams.set('page',1);
                        window.history.pushState({path:url.href},'',url.href);
                        load_category_product();
                    }

                    window.load_category_product();

                    var slider = document.getElementById('slider');
                    if(slider){
                        let min = {{(int) $min_product_price ?? 50}};
                        let max = {{(int) $max_product_price ?? 40000}};
                        noUiSlider.create(slider, {
                            start: [min, max],
                            range: {
                                'min': [min],
                                'max': [max]
                            }
                        });
                        slider.noUiSlider.on('update', function(values, handle, unencoded, tap, positions, noUiSlider) {
                            // console.log(values);
                            let [min,max]  = values;
                            min = parseInt(min);
                            max = parseInt(max);
                            min_input.value = min;
                            max_input.value = max;
                            range_value = [min, max];
                        });
                        slider.noUiSlider.on('update',debounce((values)=>{
                            load_data();
                        },1000))

                    }
                </script>
            </div>
        </div>
    </section>
@endsection
