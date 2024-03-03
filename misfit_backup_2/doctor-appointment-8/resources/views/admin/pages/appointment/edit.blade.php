@extends('admin.app.app')
@section('main-content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Example</h4>
                            <form class="repeater" action="{{ route('prescription.update',$prescription->id) }}" enctype="multipart/form-data" method="POST">
                                {{-- <input type="hidden" name="patient_id" value="{{ $appointment->user_id }}" > --}}
                                <input type="hidden" name="appointment_id" value="{{ $prescription->appointment_id }}" >
                                @csrf

        @php
            $prescriptionItems = json_decode($prescription->prescription, true);
        @endphp
                                <div data-repeater-list="prescription">
                                    @foreach($prescriptionItems as $item)
                                    <div data-repeater-item="" class="row">
                                        <div class="mb-3 col-lg-2">
                                            <label for="medicine">medicine</label>
                                            <input type="text" id="medicine" name="medicine" class="form-control" placeholder="Enter Your medicine" value="{{ $item['medicine'] }}">
                                        </div>

                                        <div class="mb-3 col-lg-2">
                                            <label for="frequency">frequency</label>
                                            <input type="frequency" name="frequency" id="frequency" class="form-control" placeholder="Enter Your frequency ID" value="{{ $item['frequency'] }}">
                                        </div>

                                        <div class="mb-3 col-lg-2">
                                            <label for="duration">duration</label>
                                            <input type="text"  name="duration" id="duration" class="form-control" placeholder="Enter Your duration" value="{{ $item['duration'] }}">
                                        </div>

                                        <div class="mb-3 col-lg-2">
                                            <label for="instruction">instruction</label>
                                            <textarea id="instruction" name="instruction" class="form-control" placeholder="Enter Your instruction"> {{ $item['instruction'] }}</textarea>
                                        </div>
                                        <div class="mb-3 col-lg-2">
                                          <label for="medication_refill">Medication Refill</label>
                                           <input type="text" id="medication_refill" name="medication_refill" class="form-control" placeholder="Enter Medication Refill" value="{{ $item['medication_refill'] ?? '' }}">
                                        </div>


                                        <div class="col-lg-2 align-self-center">
                                            <div class="d-grid">
                                                <input data-repeater-delete="" type="button" class="btn btn-primary" value="Delete">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach


                                </div>
                                <input data-repeater-create="" type="button" class="btn btn-success mt-3 mt-lg-0" value="Add">
                                <input type="submit" class="btn btn-primary mt-3 mt-lg-0" value="Save">
                            </form>
                        </div>
                    </div>
                </div>
            </div>v>
</div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


</div>
@endsection
