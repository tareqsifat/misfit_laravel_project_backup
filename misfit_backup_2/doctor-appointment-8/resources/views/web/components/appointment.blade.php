@auth
<section class="section">
    <div class="">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0 shadow rounded overflow-hidden">
                    <ul
                      class="nav nav-pills nav-justified flex-column flex-sm-row rounded-0 shadow overflow-hidden bg-light mb-0"
                      id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link rounded-0 active" id="clinic-booking" data-bs-toggle="pill"
                              href="#pills-clinic" role="tab" aria-controls="pills-clinic" aria-selected="true">
                                <div class="text-center pt-1 pb-1">
                                    <h5 class="fw-medium mb-0">Book Appointment</h5>
                                </div>
                            </a>
                            <!--end nav link-->
                        </li>
                        <!--end nav item-->

                    </ul>

                    <div class="tab-content p-4" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-clinic" role="tabpanel"
                          aria-labelledby="clinic-booking">
                            <form action="{{ route('appointment.store') }}" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="mb-3">

                                            <label class="form-label" for="location">Select Doctor <span
                                                  class="text-danger">*</span></label>
                                            <select class="form-control" onchange="fetchAvailableDates()" id="doctor"
                                              name="doctor" required>
                                                @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">

                                            <label class="form-label" for="location">Select Place <span
                                                  class="text-danger">*</span></label>
                                            <select class="form-control" onchange="fetchAvailableDates()" id="location"
                                              name="location">
                                                <option value="">Select Location</option>
                                                @foreach ($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">

                                            <label class="form-label" for="location">Date & Time <span
                                                  class="text-danger">*</span></label>
                                            <select class="form-control" id="available-dates" name="available_dates">
                                                <option value="">Select Availability</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Patient Name <span
                                                  class="text-danger">*</span></label>
                                            <input name="name" id="name" type="text" class="form-control"
                                              placeholder="Patient Name :" value="{{ Auth::user()->name }}" readonly>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
    <div class="mb-1">
        <label class="form-label">Patient Problem <span class="text-danger">*</span></label>
        <textarea name="problem" id="problem" rows="4" class="form-control" placeholder="Describe your problem"></textarea>
    </div>
</div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Your Email <span
                                                  class="text-danger">*</span></label>
                                            <input name="email" id="email" type="email" class="form-control"
                                              placeholder="Your email :" value="{{ Auth::user()->email }}" readonly>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Your Phone <span
                                                  class="text-danger">*</span></label>
                                            <input name="phone" id="phone" type="tel" class="form-control"
                                              placeholder="Your Phone :" value="{{ Auth::user()->phone }}" readonly>
                                        </div>
                                    </div>
                                

                                    <div class="col-lg-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-light">Book An Appointment</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
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

@else
<section class="section">
    <div class="">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0 shadow rounded overflow-hidden">
                    <ul
                      class="nav nav-pills nav-justified flex-column flex-sm-row rounded-0 shadow overflow-hidden bg-light mb-0"
                      id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link rounded-0 active" id="clinic-booking" data-bs-toggle="pill"
                              href="#pills-clinic" role="tab" aria-controls="pills-clinic" aria-selected="true">
                                <div class="text-center pt-1 pb-1">
                                    <h5 class="fw-medium mb-0">Book Appointment</h5>
                                </div>
                            </a>
                            <!--end nav link-->
                        </li>
                        <!--end nav item-->

                    </ul>

                    <div class="tab-content p-4" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-clinic" role="tabpanel"
                          aria-labelledby="clinic-booking">
                            <form action="{{ route('appointment.store') }}" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="mb-3">

                                            <label class="form-label" for="location">Select Doctor <span
                                                  class="text-danger">*</span></label>
                                            <select class="form-control" onchange="fetchAvailableDates()" id="doctor"
                                              name="doctor" required>
                                                @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->user_id }}">{{ $doctor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">

                                            <label class="form-label" for="location">Select Place <span
                                                  class="text-danger">*</span></label>
                                            <select class="form-control" onchange="fetchAvailableDates()" id="location"
                                              name="location">
                                                <option value="">Select Location</option>
                                                @foreach ($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">

                                            <label class="form-label" for="location">Date & Time <span
                                                  class="text-danger">*</span></label>
                                            <select class="form-control" id="available-dates" name="available_dates">
                                                <option value="">Select Availability</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Patient Name <span
                                                  class="text-danger">*</span></label>
                                            <input name="name" id="name" type="text" class="form-control"
                                              placeholder="Patient Name :" value="">
                                        </div>
                                    </div>
                                    <!--end col-->


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Your Email <span
                                                  class="text-danger">*</span></label>
                                            <input name="email" id="email" type="email" class="form-control"
                                              placeholder="Your email :" value="">
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Your Phone <span
                                                  class="text-danger">*</span></label>
                                            <input name="phone" id="phone" type="tel" class="form-control"
                                              placeholder="Your Phone :" value="">
                                        </div>
                                    </div>
                                    

                                    <div class="col-lg-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-light">Book An Appointment</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
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
@endauth
<script>
    function fetchAvailableDates() {
        var locationId = document.getElementById('location').value;
console.log(locationId);
        fetch('{{ url('/get-available-dates') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include this line if you're using Laravel CSRF protection
            },
            body: JSON.stringify({ location_id: locationId })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            var availableDatesDropdown = document.getElementById('available-dates');

            // Clear previous options
            availableDatesDropdown.innerHTML = '<option value="">Select Availability</option>';

            // Add new options based on the response
            data.forEach(function(date) {
                var option = document.createElement('option');
                option.value = date.id;
                option.text = date.date;
                availableDatesDropdown.appendChild(option);
            });
        })
        .catch(error => {
            console.error(error);
        });
    }


</script>