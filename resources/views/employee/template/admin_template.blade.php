<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="dark" data-sidebar-size="lg" data-sidebar="light" data-sidebar-image="none" data-preloader="disable">
    <head>

        <meta charset="utf-8" />
        <title>Mia Makler</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!-- Favicons -->
        <link rel="shortcut icon" href="{{ asset('admin_file/assets/images/favicon.ico') }}"> 
        <!-- jsvectormap css -->
        <link href="{{ asset('admin_file/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

        <!--Swiper slider css-->
        <link href="{{ asset('admin_file/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin_file/assets/css/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Layout config Js -->
        <script src="{{ asset('admin_file/assets/js/layout.js') }}"></script>
        <!-- Bootstrap Css -->
        <link href="{{ asset('admin_file/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('admin_file/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('admin_file/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- custom Css-->
        <link href="{{ asset('admin_file/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
         
 
         
    </head>
   
    <body>
        <!-- Begin page -->
        <div id="layout-wrapper">
        

            <!-- Main Header -->
            @include('employee.template.header')
            <!-- Left side column. contains the logo and sidebar -->
            @include('employee.template.sidebar')
            <div class="main-content"> 
            <!-- Content Wrapper. Contains page content -->
                  
                        @yield('content')
                    
                 
            <!-- /.content-wrapper -->
            </div>
            <!-- Main Footer -->
            @include('employee.template.footer')
 
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->
        <script src="{{ asset('admin_file/assets/js/jquery-3.6.1.min.js') }}" ></script>
        <script src="{{ asset('admin_file/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin_file/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('admin_file/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('admin_file/assets/libs/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('admin_file/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
        <script src="{{ asset('admin_file/assets/js/plugins.js') }}"></script>

        <!-- apexcharts -->
        <script src="{{ asset('admin_file/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- Vector map-->
        <script src="{{ asset('admin_file/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
        <script src="{{ asset('admin_file/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

        <!--Swiper slider js-->
        <script src="{{ asset('admin_file/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
        
        <script src="{{ asset('admin_file/assets/libs/list.js/list.min.js') }}"></script>
        <script src="{{ asset('admin_file/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>
         

        <!-- Sweet Alerts js -->
        <script src="{{ asset('admin_file/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

        <!-- form wizard init -->
        <script src="{{ asset('admin_file/assets/js/pages/form-wizard.init.js') }}"></script> 
        <script src="{{ asset('admin_file/assets/js/pages/profile-setting.init.js') }}"></script> 
        <!-- notifications init -->
        <script src="{{ asset('admin_file/assets/js/pages/notifications.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('admin_file/assets/js/flatpicker.min.js') }}"></script>

        <script src="{{ asset('admin_file/assets/libs/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('admin_file/assets/libs/fullcalendar/main.min.js') }}"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script> -->

        <script src="{{ asset('admin_file/assets/js/app.js') }}"></script>
        <script src="{{ asset('admin_file/assets/js/main.js') }}"></script>
         
        
            

         
    @yield('scripts')
     
 
    </body>
</html>