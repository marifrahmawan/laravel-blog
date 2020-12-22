<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @stack('prepend-style')

    @include('dashboard.includes.dashboard_style')

    @stack('addon-style')

</head>
<body class="hold-transition sidebar-mini text-sm">
    <div class="wrapper">
        
        @include('dashboard.includes.dashboard_navbar')
        

        @include('dashboard.includes.dashboard_sidebar')
        
        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        
        <!-- Main Footer -->
        @include('dashboard.includes.dashboard_footer')
    </div>
    <!-- ./wrapper -->
    
    <!-- REQUIRED SCRIPTS -->
    @include('dashboard.includes.dashboard_script')
    
    @stack('addon-script')
</body>
</html>