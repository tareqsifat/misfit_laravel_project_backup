@extends('admin.app.app')
@section('main-content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Create Availability</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Availabilities</a></li>
                                <li class="breadcrumb-item active">Create Availability</li>
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
                            <form method="POST" action="{{ route('availabilities.store') }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="location" class="form-label">Location</label>
                                        <select class="form-control" id="location" name="location" required>
                                            <option value="">Select a location</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    

                                    <div class="col-md-3">
                                        <label for="time" class="form-label">time</label>
                                        <input type="text" class="form-control" id="time" name="time" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="date" name="date" required>
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

@endsection
