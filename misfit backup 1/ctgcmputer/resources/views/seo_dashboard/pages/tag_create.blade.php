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
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div>
                <div class="card-header py-3 position-sticky d-flex justify-content-between align-items-center">
                    <h6>SEO Tag Create</span> </h6>
                    {{-- <a href="#/admin/news/category" class="router-link-active btn btn-info btn-sm">Back</a> --}}
                </div>
            </div>
            @php
            $selected = ["url","title","seo_title","seo_description","seo_keywords"];
            @endphp
            <div class="card-body">
                @foreach ($selected as $item)
                <div class="form-group">
                    <label for=""> {{ str_replace('_',' ',$item) }}</label>
                    <div class="mt-1 mb-3">
                        <textarea type="text" name="{{$item}}" class="form-control mb-1"></textarea>
                        @error($item)
                        <div class="text-warning">
                            {{old($item)}} &nbsp; &nbsp;
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                @endforeach
            </div>
            <div class="card-header py-2 position-sticky d-flex justify-content-start">
                <button class="btn btn-info btn-sm">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
