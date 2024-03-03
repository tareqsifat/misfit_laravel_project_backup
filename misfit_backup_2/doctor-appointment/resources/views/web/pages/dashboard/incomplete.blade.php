@extends('web.app.app')


@section('main-body')


<section class="bg-hero">
    <div class="container">
        <div class="row mt-lg-5">
            <div class="list-unstyled p-4">
                <div class="progress-box mb-4 text-center">
                    <h2 class="text-primary">Complete your profile</h2>

                </div>
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="mb-3 text-center">
                                <input type="file" class="dropify mx-auto" id="image" name="image" data-default-file="{{ asset('/') }}assets/web/images/user.png">
                                <label for="image" class="form-label"><h4>Profile Picture</h4></label>
                            </div>
                            
                            <div class="mb-3">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" class="form-control" id="birthday" name="birthday">
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="mb-3">
                                <label for="height" class="form-label">Height</label>
                                <input type="text" class="form-control" id="height" name="height">
                            </div>
                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight</label>
                                <input type="text" class="form-control" id="weight" name="weight">
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender">
                                    <option value="female" selected>Female</option>
                                    <option value="male">Male</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="blood_group" class="form-label">Blood Group</label>
                                <select class="form-select" id="blood_group" name="blood_group">
                                    <option value="N/A" selected>Not Identified</option>
                                    <option value="B+" selected>B+</option>
                                    <option value="A+">A+</option>
                                    <option value="O+">O+</option>
                                    <option value="AB+">AB+</option>
                                    <option value="B-">B-</option>
                                    <option value="A-">A-</option>
                                    <option value="O-">O-</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>

                            <button class="btn btn-primary mx-auto text-center">save</button>
                        </form>
                        
                        
                    </div>
                </div>
                
            </div>
        </div><!--end row-->
    </div><!--end container-->
</section>


@endsection