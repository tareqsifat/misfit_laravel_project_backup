<!-- JAVASCRIPT -->
<script src="{{ asset('') }}assets/admin/libs/jquery/jquery.min.js"></script>
<!-- Javascript -->
<script src="{{ asset('/') }}assets/web/libs/tiny-slider/min/tiny-slider.js"></script>
<script src="{{ asset('/') }}assets/web/libs/tobii/js/tobii.min.js"></script>
<script src="{{ asset('/') }}assets/web/libs/feather-icons/feather.min.js"></script>
<!-- JAVASCRIPT -->
<script src="{{ asset('/') }}assets/web/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/') }}assets/web/js/plugins.init.js"></script>
<!-- Sweet Alerts js -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="{{ asset('') }}assets/admin/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"
  integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="{{ asset('/') }}assets/web/js/app.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
      pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
      },
      autoplay: {
        delay: 1000,
        disableOnInteraction: false,
      },
    });
</script>
@if ($massage = Session::get('success'))
<script>
    Swal.fire({
          position: "top-end",
          icon: "success",
          title: "{{ $massage }}",
          showConfirmButton: !1,
          timer: 3000
          })
          Swal();
</script>
@endif



@foreach ($errors->all() as $error)

<script>
    Swal.fire({
        position: "top-end",
        icon: "Error",
        title: "{{ $error }}",
        showConfirmButton: !1,
        timer: 3000
        })
        Swal();
</script>
@endforeach

@if ($massage = Session::get('error'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "Error",
        title: "{{ $massage }}",
        showConfirmButton: !1,
        timer: 3000
        })
        Swal();
</script>
@endif




<script>
    $(document).ready(function() {
    // Initialize Dropify
    $('.dropify').dropify();
});
</script>
