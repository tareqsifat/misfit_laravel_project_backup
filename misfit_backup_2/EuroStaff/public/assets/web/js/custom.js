$(document).on('submit', '.login-signup-form', function (e){
    e.preventDefault();
    let formData = new FormData(this);
    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "positionClass": "toast-top-right"
    };
    // Use the FormData constructor to create a FormData object
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false, // Prevent automatic processing of the data
        contentType: false, // Prevent automatic content type header
        success: (res) => {
            $('#loginSignupModal').modal('hide');
            $('#Otp_submit_modal').modal('show');
            send_email_route();
        },
        error: (err) => {
            let errors = err.responseJSON.errors;
            if(errors){
                for (const key in errors) {
                    if (Object.hasOwnProperty.call(errors, key)) {
                        const element = errors[key];
                        toastr.error(element);
                    }
                }
            }else{
                toastr.error(err.responseJSON.message);
            }
        },
    });
});

$(document).on('submit', '.Otp_submit_form', function(event){
    event.preventDefault();
    let formData = new FormData(this); // 'this' refers to the form element
    let home_url = $('.home-route').val();
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,

        success: (res) => {
            location.reload() = home_url
            $('#Otp_submit_modal').modal('hide');
        },
        error: (err) => {
            let errors = err.responseJSON.errors;
            if(errors){
                for (const key in errors) {
                    if (Object.hasOwnProperty.call(errors, key)) {
                        const element = errors[key];
                        toastr.error(element);
                    }
                }
            }else{
                toastr.error(err.responseJSON.message);
            }
        },
    })

});

$(document).on('click','signup-tab', function(e) {
    $('#signup').toggleClass('active').toggleClass('show');
})

function send_email_route(){
    let home_url = $('.home-route').val();
    $.ajax({
        url: `${home_url}/auth/send_auth_email`,
        type: 'GET',
        data: '',
        processData: false, // Prevent automatic processing of the data
        contentType: false, // Prevent automatic content type header
        success: (res) => {
            //
        },
        error: (err) => {
            let errors = err.responseJSON.errors;
            if(errors){
                for (const key in errors) {
                    if (Object.hasOwnProperty.call(errors, key)) {
                        const element = errors[key];
                        toastr.error(element);
                    }
                }
            }else{
                toastr.error(err.responseJSON.message);
            }
        },
    });
}
