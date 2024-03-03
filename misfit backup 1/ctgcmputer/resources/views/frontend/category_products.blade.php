@php
    $meta = [];
    if (isset($category)) {
        $meta["title"] = $category->page_title;
        $meta["keywords"] = $category->meta_keywords;
        $meta["description"] = $category->meta_description;
    }
@endphp
@extends('frontend.layouts.app',[
    "meta" => $meta,
])
@section('content')

    @if($category || $brand || $tag)
        <section>
            @isset($category)
                <div class="container">
                    <ul class="breadcrumb pt-4">
                        <li>
                            <a href="/"><i class="fa fa-home" title="Home"></i></a>
                        </li>
                        <li>
                            <a href="#">
                                <span>category</span>
                            </a>
                        </li>
                        @if($category->parent)
                        <li>
                            <a href="/category/{{$category->parent->id}}/{{$category->parent->name}}">
                                <span>{{$category->parent->name}}</span>
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="/category/{{$category->id}}/{{$category->name}}" onclick="event.preventDefault();">
                                <span>{{$category->name}}</span>
                            </a>
                        </li>
                    </ul>
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
                    <div>
                        <br>
                        {!! $category->description !!}
                        <br>
                    </div>
                </div>
            @endisset
            @isset($brand)
            <div class="container">
                <ul class="breadcrumb pt-4">
                    <li>
                        <a href="/"><i class="fa fa-home" title="Home"></i></a>
                    </li>
                    <li>
                        <a href="#">
                            <span>brand</span>
                        </a>
                    </li>
                    <li>
                        <a href="/{{ $brand->url }}" onclick="event.preventDefault();">
                            <span>{{$brand->name}}</span>
                        </a>
                    </li>
                </ul>
            </div>
            @endisset
            @isset($tag)
            <div class="container">
                <ul class="breadcrumb pt-4">
                    <li>
                        <a href="/"><i class="fa fa-home" title="Home"></i></a>
                    </li>
                    <li>
                        <a href="#">
                            <span>Tag</span>
                        </a>
                    </li>
                    <li>
                        <a href="/{{ $tag->url }}" onclick="event.preventDefault();">
                            <span>{{$tag->name}}</span>
                        </a>
                    </li>
                </ul>
            </div>
            @endisset
        </section>

        <section style="background: #f2f4f8;">
            <div class="container py-3">
                <div class="category_products_row">
                    <link rel="stylesheet" href="/contents/frontend/assets/css/plugins/range_slider.css" />
                    <script src="/contents/frontend/assets/js/plugins/range_slider.js"></script>
                    <script src="/contents/frontend/assets/js/plugins/debounce.js"></script>
                    <div class="filter_card_list">
                        @if ($max_product_price)
                            <div class="mb-3 bg-white filter_card">
                                <div class="card-header bg-white">
                                    <b>
                                        Price Range
                                    </b>
                                </div>
                                <div class="p-2">
                                    <div id="anchor2"></div>
                                    <div class="d-flex justify-content-between gap-4">
                                        <input type="number" id="min_input" value="{{request()->min ?? $min_product_price}}" onkeyup="set_min_max(0,event.target.value)" class="form-control p-1 rounded-0" />
                                        <input type="number" id="max_input" value="{{request()->max ?? $max_product_price}}" onkeyup="set_min_max(1,event.target.value)" class="form-control p-1 rounded-0" />
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mb-3 bg-white filter_card">
                            <div class="card-header bg-white d-flex justify-content-between">
                                <b>
                                    Availability
                                </b>
                                <b>
                                    <i class="fa fa-angle-down" onclick="stock_list.classList.toggle('d-none')"></i>
                                </b>
                            </div>
                            <div class="p-2 d-block" id="stock_list">
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
                            <div class="card-header bg-white d-flex justify-content-between">
                                <b>
                                    Brands
                                </b>
                                <b>
                                    <i class="fa fa-angle-down" onclick="brand_list.classList.toggle('d-none')"></i>
                                </b>
                            </div>
                            <div class="p-2 d-block" id="brand_list">

                            </div>
                        </div>
                    </div>
                    <div >
                        <section class="bg-white">
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
                    </div>
                    <script>
                        var range_value = [];
                        var brands = '';
                        var availability = '';

                        function set_min_max(index=0,value=0){
                            range_value[index] = value;
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

                            url.searchParams.forEach((i,k)=>k.includes('brands') && url.searchParams.delete(k))
                            if(brands.length){
                                brands.forEach((i,index)=>url.searchParams.set(`brands[${index}]`,i));
                            }

                            if(availability){
                                url.searchParams.set('availability',availability);
                            }

                            url.searchParams.set('page',1);
                            window.history.pushState({path:url.href},'',url.href);
                            load_category_product();
                            // Turbolinks.visit(url.href);
                        }

                        $(function(){
                            setTimeout(() => {
                                $('#anchor2').html('');
                                if($('#anchor2')[0]){
                                    $('#anchor2').rangeSlider({
                                        settings: false,
                                        skin: 'red',
                                        type: 'interval',
                                        scale: false,
                                    },{
                                        min: {{(int) $min_product_price ?? 50}},
                                        max: {{(int) $max_product_price ?? 40000}},
                                        step: 1,
                                        values: [{{request()->min ?? (int)$min_product_price}}, {{request()->max ?? (int) $max_product_price}}]
                                    });
                                    $('#anchor2').rangeSlider('onChange',(event)=>{
                                        var [min, max] = event.detail.values;
                                        min_input.value = min;
                                        max_input.value = max;
                                    })
                                    $('#anchor2').rangeSlider('onChange',debounce((event)=>{
                                        range_value = event.detail.values;
                                        load_data();
                                    },1000))
                                }

                            }, 1000);
                        })
                    </script>
                </div>
            </div>
        </section>
    @else
        <div class="text-center">
            There no product according to this category
        </div>
    @endif
@endsection
