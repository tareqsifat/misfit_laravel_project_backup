// $(function(){
//     $('.insert_form').on('submit', function (e) {
//         e.preventDefault();
//         let formData = new FormData($(this)[0]);
//         $.ajax({
//             url: $(this).attr('action'),
//             type: 'POST',
//             data: formData,
//             success: (res) => {
//                 Toaster('success', 'data inserted successfully.');
//                 $(this).trigger('reset');
//                 $('.note-editable').html('');
//                 $('.preloader').hide();
//                 console.log(formData);
//             },
//             error: (err) => {
//                 let errors = err.responseJSON.errors;
//                 for (const key in errors) {
//                     if (Object.hasOwnProperty.call(errors, key)) {
//                         const element = errors[key];
//                         $(`.${key}`).text(element);
//                         console.log(formData);
//                     }
//                 }
//                 Toaster('error', 'Check below for errors');
//                 $('.preloader').hide();
//             },
//             beforeSend: () => {
//                 $('.preloader').show();
//             },
//         });
//     });
// })