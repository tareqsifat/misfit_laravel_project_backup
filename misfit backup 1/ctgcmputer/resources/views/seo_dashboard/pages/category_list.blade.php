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
    <div class="card">
        <div>
            <div class="card-header py-3 position-sticky d-flex justify-content-between align-items-center">
                <h6>Categories</h6>
                <div class="text-end">
                    <form action="">
                        <input type="text" value="{{request()->key}}" class="form-control" name="key">
                    </form>
                </div>
                {{-- <a href="#/admin/news/category" class="router-link-active btn btn-info btn-sm">Back</a> --}}
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-stripe">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>URL</th>
                        <th style="width: 200px;" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="/{{ $item->url }}" target="_blank">{{ $item->url }}</a>
                            </td>
                            <td>
                                <div class="text-center">
                                    <a href="{{ route('ctegories_set',$item->id) }}" class="btn btn-sm btn-secondary">Set SEO</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-header py-2 position-sticky d-flex justify-content-start">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
