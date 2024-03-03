@extends('seo_dashboard.layouts.seo')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h5> SEO Management </h5>
            </div>
            <div class="col-lg-6"></div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <form action="{{ route('seo_website_update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div>
                <div class="card-header py-3 position-sticky d-flex justify-content-between align-items-center">
                    <h6>Website home page SEO</h6>
                    {{-- <a href="#/admin/news/category" class="router-link-active btn btn-info btn-sm">Back</a> --}}
                </div>
            </div>
            @php
                $selected = ["seo_title","seo_description","seo_classification","seo_hot_line", "seo_keywords"];
                $seo_infos = \App\Models\Setting::select($selected)->addSelect("seo_image")->first();
            @endphp
            <div class="card-body">
                @foreach ($selected as $item)
                <div class="form-group">
                    <label for=""> {{ str_replace('_',' ',$item) }}</label>
                    <div class="mt-1 mb-3">
                        <textarea type="text" name="{{$item}}" class="form-control mb-1">{{$seo_infos->$item}}</textarea>
                    </div>
                </div>
                @endforeach
                <div class="form-group">
                    <label for=""> {{ str_replace('_',' ',"seo_image") }}</label>
                    <div class="mt-1 mb-3">
                        <input type="file" name="seo_image" accept=".jpg,.jpeg,.png" class="form-control mb-1"/>

                        <div class="mt-2">
                            <img src="{{asset($seo_infos->seo_image)}}" style="height: 80px;" class="img-thumbnail" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header py-2 position-sticky d-flex justify-content-start">
                <button class="btn btn-info btn-sm">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
