@extends('web.app.app')


@section('main-body')
@php
$user = Auth::user();

use Carbon\Carbon;

$birthdate = Carbon::parse($user->profile->birthday);
$currentDate = Carbon::now();
$age = $birthdate->diffInYears($currentDate);
$bday = Carbon::parse($user->profile->birthday)->format('jS F Y');
@endphp
<section class="bg-hero">
    <div class="container">
        <div class="row mt-lg-5">
            <div class="col-md-6 col-lg-4">
                <div class="rounded shadow overflow-hidden sticky-bar">
                    <div class="card border-0">
                        <img src="{{ asset('/assets/web/images/bg/bg-profile.jpg') }}" class="img-fluid" alt="">
                    </div>

                    <div class="text-center avatar-profile margin-nagative mt-n5 position-relative pb-4 border-bottom">
                        <img src="{{ asset('uploads/patient/' . $user->profile->image) }}"
                          class="rounded-circle shadow-md avatar avatar-md-md" alt=""
                          style="width: 130px; height: 130px;  object-fit: cover;">

                   
                        <h5 class="mt-3 mb-1">{{ $user->name }}</h5>
                        <p class="text-muted mb-0">{{ $age }} Years old</p>
                    </div>

                    <div class="list-unstyled p-4">
                        <div class="progress-box mb-4">
                            <h6 class="title">Complete your profile</h6>
                            <div class="progress">
                                <div class="progress-bar position-relative bg-primary" style="width:89%;">
                                    <div class="progress-value d-block text-muted h6">89%</div>
                                </div>
                            </div>
                        </div>
                        <!--end process box-->

                        <div class="d-flex align-items-center mt-2">
                            <i class="uil uil-user align-text-bottom text-primary h5 mb-0 me-2"></i>
                            <h6 class="mb-0">Gender</h6>
                            <p class="text-muted mb-0 ms-2">{{ $user->profile->gender }}</p>
                        </div>

                        <div class="d-flex align-items-center mt-2">
                            <i class="uil uil-envelope align-text-bottom text-primary h5 mb-0 me-2"></i>
                            <h6 class="mb-0">Birthday</h6>
                            <p class="text-muted mb-0 ms-2">{{ $bday }}</p>
                        </div>

                        <div class="d-flex align-items-center mt-2">
                            <i class="uil uil-book-open align-text-bottom text-primary h5 mb-0 me-2"></i>
                            <h6 class="mb-0">Phone No.</h6>
                            <p class="text-muted mb-0 ms-2">{{ $user->phone }}</p>
                        </div>

                        <div class="d-flex align-items-center mt-2">
                            <i class="uil uil-italic align-text-bottom text-primary h5 mb-0 me-2"></i>
                            <h6 class="mb-0">Address</h6>
                            <p class="text-muted mb-0 ms-2">{{ $user->profile->address }}</p>
                        </div>

                        <div class="d-flex align-items-center mt-2">
                            <i class="uil uil-medical-drip align-text-bottom text-primary h5 mb-0 me-2"></i>
                            <h6 class="mb-0">Blood Group</h6>
                            <p class="text-muted mb-0 ms-2">{{ $user->profile->blood_group }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->

            <div class="col-lg-8 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="card border-0 shadow overflow-hidden">
                    <ul
                      class="nav nav-pills nav-justified flex-column flex-sm-row rounded-0 shadow overflow-hidden bg-light mb-0"
                      id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link rounded-0 active" id="overview-tab" data-bs-toggle="pill"
                              href="#pills-overview" role="tab" aria-controls="pills-overview" aria-selected="true">
                                <div class="text-center pt-1 pb-1">
                                    <h4 class="title fw-normal mb-0">Profile</h4>
                                </div>
                            </a>
                            <!--end nav link-->
                        </li>
                        <!--end nav item-->

                        <li class="nav-item" role="presentation">
                            <a class="nav-link rounded-0" id="experience-tab" data-bs-toggle="pill"
                              href="#pills-experience" role="tab" aria-controls="pills-experience" aria-selected="false"
                              tabindex="-1">
                                <div class="text-center pt-1 pb-1">
                                    <h4 class="title fw-normal mb-0">Profile Settings</h4>
                                </div>
                            </a>
                            <!--end nav link-->
                        </li>
                        <!--end nav item-->
                    </ul>

                    <div class="tab-content p-4" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-overview" role="tabpanel"
                          aria-labelledby="overview-tab">
                            @if($appointments->count() > 0)
                            <div class="row">
                                <div class="col-lg-6 col-12 mt-4">
                                    <h5 style="color: white;">Appointment List</h5>
                                    @foreach ($appointments as $appointment)
                                    <div
                                      class="d-flex justify-content-between align-items-center rounded p-3 shadow mt-3">
                                        <i class="ri-heart-pulse-line h3 fw-normal text-primary mb-0"></i>
                                        <div class="flex-1 overflow-hidden ms-2">
                                            <h6 style="color: white;"class="mb-0">{{ $appointment->timetable->date }}</h6>
                                            <small style="color: white;"class="my-1">{{ $appointment->timetable->time }}</small>
                                            <p style="color: white;"class="text-muted mb-0 text-truncate small">
                                                {{ $appointment->timetable->getlocation->name }}
                                            </p>
                                        </div>

                                    </div>
                                    @endforeach


                                </div>

                                <div class="col-lg-6 col-12 mt-4">
                                    <h5 style="color: white;">prescription</h5>

                                    @foreach ($appointments as $appointment)
                                    @if ($appointment->status == 1)
                                    <div
                                    class="d-flex justify-content-between align-items-center rounded p-3 shadow mt-3">
                                      <div class="flex-1 overflow-hidden">
                                        <h6 class="flex-1 mb-0" style="color: white;">
                                              {{ $appointment->prescription->created_at->format('jS F Y') }}
                                          </h6>
                                          <a style="color: white;"href="{{ route('appointment.print', $appointment->id) }}"
                                            class="text-muted mb-0 text-truncate small">
                                              Print</a>
                                      </div>
                                  </div>
                                  @else
                                  <div
                                    class="d-flex justify-content-between align-items-center rounded p-3 shadow mt-3">
                                      <div class="flex-1 overflow-hidden">
                                          <h6 class="flex-1 mb-0">
                                            <span class="badge rounded-pill bg-info text-dark">Pending</span>
                                          </h6>

                                      </div>
                                  </div>
                                    @endif

                                    @endforeach




                                </div>
                            </div>

                            @else

                            <h3>No prescriptions Availble</h3>
                            @endif
                            <!--end row-->
                        </div>

                        <div class="tab-pane fade" id="pills-experience" role="tabpanel"
                          aria-labelledby="experience-tab">
                            <h5 class="mb-0">Personal Information :</h5>
                            <!--end row-->

                            <form class="mt-4" action="{{ route('profile.update',$user->id) }}" method="POST"
                              enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-4">
            
 <input type="file" name="image"
 data-default-file="{{ asset('') }}public/patient/{{ $user->profile->image }}"
 class="dropify" alt="">
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-6 col-md-12 text-center text-md-start mt-4 mt-sm-0">
                                        <h6 class="">Upload your picture</h6>
                                        <p class="text-muted mb-0">For best results, use an image at least
                                            256px by 256px in either .jpg or .png format</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input name="name" id="name" type="text" class="form-control"
                                              placeholder="User Name :" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <!--end col-->


                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Your Email</label>
                                            <input name="email" id="email" type="email" class="form-control"
                                              placeholder="Your email :" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Phone no.</label>
                                            <input name="phone" id="number" type="text" class="form-control"
                                              placeholder="Phone no. :" value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input name="address" id="address" type="text" class="form-control"
                                              placeholder="User Address :" value="{{ $user->profile->address }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">height</label>
                                            <input name="height" id="height" type="text" class="form-control"
                                              placeholder="User height :" value="{{ $user->profile->height }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">weight</label>
                                            <input name="weight" id="weight" type="text" class="form-control"
                                              placeholder="User weight :" value="{{ $user->profile->weight }}">
                                        </div>
                                    </div>

                                </div>
                                <!--end row-->

                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="submit" id="submit" name="send" class="btn btn-primary"
                                          value="Save changes">
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                            <!--end form-->

                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
@endsection
