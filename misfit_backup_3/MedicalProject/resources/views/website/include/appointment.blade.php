
<form method="POST" class="row mb-0" id="template-medical-form" action="{{ route('appointments_store') }}" enctype="multipart/form-data">
    @csrf
    <div class="col-md-8 form-group">
        <label for="template-medical-name">Name:</label>
        <input type="text" id="template-medical-name" name="name" class="form-control not-dark required" placeholder="Name">
        @error('name')
            <div class="text-theme-6 mt-2">{{ $message }}<br></div>
        @enderror
    </div>
    <div class="col-md-4 form-group">
        <label for="template-medical-phone">Phone:</label>
        <input type="text" id="template-medical-phone" name="phone" class="form-control not-dark required" placeholder="Phone">
        @error('phone')
            <div class="text-theme-6 mt-2">{{ $message }}<br></div>
        @enderror
    </div>
    <div class="w-100"></div>
    <div class="col-md-8 form-group">
        <label for="template-medical-email">Email Address:</label>
        <input type="email" id="template-medical-email" name="email" class="form-control not-dark required" placeholder="Email">
    </div>
    <div class="col-md-4 form-group">
        <label for="template-medical-dob">Date of Birth:</label>
        <input type="date" id="template-medical-dob" name="dateOfBirth" class="form-control not-dark required"  placeholder="DD/MM/YYYY">
        @error('dateOfBirth')
            <div class="text-theme-6 mt-2">{{ $message }}<br></div>
        @enderror
    </div>
    <div class="w-100"></div>
    <div class="col-md-5">
        <div class="row">
            <div class="col-12 form-group">
                <label for="template-medical-appoint-date">Appointment Date:</label>
                <input type="date" id="template-medical-appoint-date" name="appointmentDate" class="form-control not-dark required" placeholder="DD/MM/YYYY">
                @error('appointment')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                @enderror
            </div>
            <div class="col-12 form-group">
                <label for="template-medical-second-booking">Booked with us Before?</label><br>
                <label class="rightmargin-sm">
                    <input type="radio" id="bookedbefore" name="bookedbefore" value="1">
                    Yes
                </label>
                <label>
                    <input type="radio" name="bookedbefore" value="0">
                    No
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-7 form-group">
        <label for="template-medical-message">Message:</label>
        <textarea id="template-medical-message" name="message" class="form-control not-dark required" cols="30" rows="5" placeholder="Message"></textarea>
    </div>
    <div class="w-100"></div>
    <div class="col-12 form-group d-none">
        <input type="text" name="template-medical-botcheck" value="" />
    </div>
    <div class="col-12 form-group text-end">
        {{-- <input type="button" style="margin-bottom: 30px" class="btn btn-primary" value="add  appointment"> --}}
        <button type="submit" id="submit_button" style="margin-bottom: 30px" class="btn btn-primary"><i class="icon-lock"></i> Add</button>
    </div>
</form>
<script>
    function myFunction() {
        document.getElementById("template-medical-form").reset();
    }
</script>