<!doctype html>
<html lang="en" dir="ltr">

    <head>
        @include('web.inc.head')

    </head>


    <body>

        <!-- Navbar STart -->
        @include('web.inc.header')
        <!--end header-->
        <!-- Navbar End -->
        @yield('main-body')


        <!-- Start -->
        @include('web.components.timetable')
        @include('web.components.achivements')
        @include('web.inc.footer')
        <!--end footer-->
        <!-- End -->

        <!-- Back to top -->
        <a href="#" onclick="topFunction()" id="back-to-top"
          class="back-to-top fs-5 rounded-pill text-center bg-primary justify-content-center align-items-center"><i
              class="ri-arrow-up-line"></i></a>
        <!-- Back to top -->

        @include('web.inc.canvas')

        @include('web.inc.script')

    </body>

</html>