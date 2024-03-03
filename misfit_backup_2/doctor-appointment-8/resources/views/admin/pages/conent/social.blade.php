@extends('admin.app.app')
@section('main-content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Social Content</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">content</a></li>
                                <li class="breadcrumb-item active">Social Content</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('social.update', $content->id) }}"
                              enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="facebook" class="form-label">Facebook</label>
                                        <input type="text" class="form-control" id="facebook" name="facebook"
                                          value="{{ $content->facebook }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="linkdin" class="form-label">Linkdin</label>
                                        <input type="text" class="form-control" id="linkdin" name="linkdin"
                                          value="{{ $content->linkdin }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="youtube" class="form-label">Youtube</label>
                                        <textarea type="text" class="form-control" id="youtube" name="youtube"
                                          required>{{ $content->youtube }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="whatsapp" class="form-label">whatsapp</label>
                                        <textarea type="text" class="form-control" id="whatsapp" name="whatsapp"
                                          required>{{ $content->whatsapp }}</textarea>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- page-content -->


    {{-- </div> --}}
    @endsection