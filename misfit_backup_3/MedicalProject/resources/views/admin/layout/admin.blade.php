<!DOCTYPE html>

<html lang="en" class="light">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rubick admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Rubick Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    
    <title>Dashboard Blog Create</title>
    <!-- BEGIN: CSS Assets-->
    @include('admin.part.part_css')
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body class="main">
    {{-- @extends('layouts.app') --}}
    <!-- BEGIN: Mobile Menu -->
    @include('admin.include.mobile_menu')
    <!-- END: Mobile Menu -->
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        @include('admin.include.side_nav')
        <!-- END: Side Menu -->
        
        
        <div class="content">
            
            <!-- BEGIN: Top Bar -->
            @include('admin.include.top_bar')
            <!-- END: Top Bar -->
            
            {{-- Start Content Section --}}
            @yield('content')
            {{-- End Content Section --}}

        </div>

            <!-- BEGIN: JS Assets-->
            @include('admin.part.part_Js')
            <!-- END: JS Assets-->
    </div>

</body>
</html>
