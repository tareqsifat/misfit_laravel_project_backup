@extends('admin.app.app')
@section('main-content')
<!-- Include the Flatpickr library -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>

<!-- Include the Popper.js library (required by Flatpickr) -->
<script src="https://cdnjs.cloudflare.com/
ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>

<style>
    .flatpickr-calendar {
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    display: none; /* Hide it by default */
}

/* Adjust z-index as needed to ensure it's displayed above other elements */
.flatpickr-calendar.open {
    display: block;
    z-index: 9999;
}
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Example</h4>
                            <form class="repeater" action="{{ route('prescription.store') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" name="patient_id" value="{{ $appointment->user_id }}" >
                                <input type="hidden" name="appointment_id" value="{{ $appointment->appointment_id }}" >
                                
                                <div data-repeater-list="prescription">
                                    <div data-repeater-item="" class="row">
                                        <div class="mb-3 col-lg-2">
                                            <label for="medicine">medicine</label>
                                            <input type="text" id="medicine" name="medicine" class="form-control" placeholder="Enter Your medicine">
                                        </div>

                                        <div class="mb-3 col-lg-2">
                                            <label for="frequency">frequency</label>
                                            <input type="frequency" name="frequency" id="frequency" class="form-control" placeholder="Enter Your frequency ID">
                                        </div>

                                        <div class="mb-3 col-lg-2">
                                            <label for="duration">duration</label>
                                            <input type="text"  name="duration" id="duration" class="form-control" placeholder="Enter Your duration">
                                        </div>

                                        <div class="mb-3 col-lg-2">
                                            <label for="instruction">instruction</label>
                                            <textarea id="instruction" name="instruction" class="form-control" placeholder="Enter Your instruction"></textarea>
                                        </div>
                                        <div class="mb-3 col-lg-2">
                                            <label for="medication_refill">Medication Refill</label>
                                            <input type="date" id="date" name="date">
                                            {{-- <button type="button" class="btn btn-primary" id="medication_refill_button">Select</button> --}}
                                        </div>
                                        
                                        

                                        <div class="col-lg-2 align-self-center">
                                            <div class="d-grid">
                                                <input data-repeater-delete="" type="button" class="btn btn-primary" value="Delete">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <input data-repeater-create="" type="button" class="btn btn-success mt-3 mt-lg-0" value="Add">
                                <input type="submit" class="btn btn-primary mt-3 mt-lg-0" value="Save">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


</div>
<script>
    // document.addEventListener("DOMContentLoaded", function () {
    //     const medicationRefillInput = document.querySelector("#medication_refill");
    //     const medicationRefillButton = document.querySelector("#medication_refill_button");

    //     const picker = flatpickr(medicationRefillInput, {
    //         enableTime: true,
    //         dateFormat: "Y-m-d H:i",
    //         static: true,
    //         onClose: function () {
    //             picker.close();
    //         }
    //     });

    //     medicationRefillButton.addEventListener("click", function () {
    //         picker.open();
    //     });
    // });
</script>


@endsection
