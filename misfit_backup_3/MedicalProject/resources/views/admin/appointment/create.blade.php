@extends('admin.layout.admin')

@section('content')
    @include('admin.part.alart')
    <!-- BEGIN: Horizontal Form -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Appointment Create
            </h2>
            <div class="form-check w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('appointments.index') }}" class="btn btn-primary"><i class="icon-backward"></i>
                     Back</a>
            </div>
        </div>
        <form method="POST" class="insert_form" action="{{ route('appointments.store') }}" enctype="multipart/form-data" id="horizontal-form">
            @csrf
            <div class="preview">
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Name</label>
                    @error('name')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="name" type="text" class="form-control" placeholder="Name">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Phone</label>
                    @error('phone')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="phone" type="text" class="form-control" placeholder="Phone">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Email</label>
                    @error('email')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="email" type="text" class="form-control" placeholder="email">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Date of Birth</label>
                    @error('dateOfBirth')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="dateOfBirth" type="date" class="form-control" placeholder="Date of Birth">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Appointment Date</label>
                    @error('appointmentDate')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="appointmentDate" type="date" class="form-control" placeholder="Appointment Date">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Message</label>
                    @error('message')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <textarea name="message" id="horizontal-form-1" class="form-control"></textarea>
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Booked Before</label>
                    @error('bookedbefore')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <select name="bookedbefore" class="form-control" id="">
                        <option value="1">yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="sm:ml-20 sm:pl-5 mt-5">
                    <button type="submit" style="margin-bottom: 30px" class="btn btn-primary"><i class="icon-lock"></i> Add</button>
                </div>
            </div>
        </form>

        <script>
            function myFunction() {
              document.getElementById("horizontal-form").reset();
            }
        </script>
    </div>
    <!-- END: Horizontal Form -->
@endsection