<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ str_replace('_', '-', app()->getLocale()) == 'ar' ? 'dir=rtl' : 'dir=ltr' }}>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>shopify</title>
    <link rel="icon" href=" {{ asset('assets/admin/images/shopify-icon.svg') }}" type="image/png">
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="{{ global_asset('assets/landlord/admin/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ global_asset('assets/landlord/admin/css/simple-chart.css') }}">
    <link rel="stylesheet" href="{{ global_asset('assets/landlord/admin/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ global_asset('assets/landlord/admin/css/all.css') }}">
    <link rel="stylesheet" href="{{ global_asset('assets/landlord/admin/css/smartphoto.css') }}">
    <link rel="stylesheet" href="{{ global_asset('assets/landlord/admin/css/css-date/classic.date.css') }}">
    <link rel="stylesheet" href="{{ global_asset('assets/landlord/admin/css/css-date/classic.css') }}">
    <link rel="stylesheet" href="{{ global_asset('assets/landlord/admin/css/jquery.mCustomScrollbar.css') }}" />
    <link href="{{ global_asset('assets/landlord/admin/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/responsive.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/skins/ui/oxide/skin.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/skins/ui/oxide/content.min.css">
    <!-- page builder CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/admin/css/pagebuilder.css') }}" /> -->
    {{-- text editer js  --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
          selector: 'textarea#editor',
        });
      </script>
    <script src="{{ global_asset('assets/landlord/admin/js/jquery-3.6.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ global_asset('assets/landlord/admin/js/popper.min.js') }}"></script>
    <script src="{{ global_asset('assets/landlord/admin/js/bootstrap.min.js') }}"></script>

</head>

<body>
    <div class="main-container">

    @include('tenant.admin.partials.sidebar')
        <div class="main-content-container">
            @yield('content')
        </div>
    </div>
    <div class="dashboard-footer">&copy; {{date('Y')}} Shopify. All rights reserved.</div>
    <script src="{{global_asset('assets/common/js/jquery.dataTables.min.js')}}"></script>
<script src="{{global_asset('assets/common/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{global_asset('assets/common/js/dataTables.responsive.min.js')}}"></script>
<script src="{{global_asset('assets/common/js/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
 <script src="{{ global_asset('assets/landlord/admin/js/Chart.min.js') }}"></script>
    <script src="{{ global_asset('assets/landlord/admin/js/charts.js') }}"></script> 
     <script src="{{ global_asset('assets/landlord/admin/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ global_asset('assets/landlord/admin/js/js-date/picker.js') }}"></script>
    <script src="{{ global_asset('assets/landlord/admin/js/js-date/picker.date.js') }}"></script>
    <!-- <script src="{{ global_asset('assets/landlord/admin/js/my.js') }}"></script> -->
    
    {{-- text editer js  --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js" integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    {{-- text editer js  end --}}
    <!-- Form Builder JS -->
    <script src="{{ global_asset('assets/landlord/admin/builder-js/vendor.min.js?v=3.3.0') }}"></script>
    <script src="{{ global_asset('assets/landlord/admin/builder-js/form-builder.min.js') }}"></script>
    <script src="{{ global_asset('assets/landlord/admin/builder-js/form-render.min.js') }}"></script>
    <!-- Form Builder JS  end-->
    <script src="{{ global_asset('assets/landlord/admin/js/jquery-smartphoto.min.js') }}"></script>
    <script src="{{ global_asset('assets/landlord/admin/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script src="{{global_asset('assets/common/js/jquery.dataTables.js')}}"></script>

    <script>
      jQuery(($) => {
        $(".build-wrap").formBuilder();
      });
    </script>
<script>
     (function($){
            "use strict";
            $('.table-wrap > table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );

        })(jQuery);
      
       

   
    $(document).ready(function() {

        // $('#mySelect').select2();
        // $('#varient').select2();
        // $('#headFamily').select2();
        // $('#headVarient').select2();
        // const lineNumbers = document.getElementById("line-numbers");
        // const cssEditor = document.getElementById("css-editor");
        // const output = document.getElementById("output");

        // cssEditor.addEventListener("input", function () {
        //     const cssCode = cssEditor.value;
        //     output.style.cssText = cssCode;

        //     // Update line numbers
        //     const lines = cssCode.split("\n").length;
        //     lineNumbers.innerHTML = Array.from({ length: lines }, (_, i) => i + 1).join("<br>");
        // });


        const lineNumbers1 = document.getElementById("line-numbers1");
        const jsEditor = document.getElementById("js-editor");
        const output1 = document.getElementById("output1");

        jsEditor.addEventListener("input", function () {
            const jsCode = jsEditor.value;

            // Display line numbers
            const lines = jsCode.split("\n").length;
            lineNumbers1.innerHTML = Array.from({ length: lines }, (_, i) => i + 1).join("<br>");

            // Execute the JavaScript code and display the output
            try {
                output1.innerHTML = eval(jsCode);
            } catch (error) {
                output1.innerHTML = "Error: " + error.message;
            }
        });
        
    });
</script>

    <script>
        $(".main-category-menu").mCustomScrollbar({
            /*setHeight:300,*/
            autoHideScrollbar: true,
            theme: "minimal-dark"
        });
    </script>
    <script>
        // document.querySelector(".integer_exclude").addEventListener("keypress", function(evt) {
        //     if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57) {
        //         evt.preventDefault();
        //     }
        // });
    </script>
    <script type="text/javascript">
        
        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll('.sidebar-nav .nav-link').forEach(function(element) {

                element.addEventListener('click', function(e) {

                    let nextEl = element.nextElementSibling;
                    let parentEl = element.parentElement;

                    if (nextEl) {
                        e.preventDefault();
                        let mycollapse = new bootstrap.Collapse(nextEl);

                        if (nextEl.classList.contains('show')) {
                            mycollapse.hide();
                        } else {
                            mycollapse.show();
                            // find other submenus with class=show
                            var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                            // if it exists, then close all of them
                            if (opened_submenu) {
                                new bootstrap.Collapse(opened_submenu);
                            }

                        }
                    }

                });
            })

        });
        // DOMContentLoaded  end
    </script>
    {{-- @stack('my_scripts')     --}}
</body>

</html>