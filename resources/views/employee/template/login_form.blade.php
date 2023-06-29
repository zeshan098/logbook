<!DOCTYPE html>
 
<html>
    <head>
    <meta charset="utf-8" />
    <title>Mia Makler</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_file/assets/images/favicon.ico') }}">

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
    <div class="auth-page-wrapper pt-5">
       
     <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        @yield('content')
 
    </div>
    <script src="{{ asset('admin_file/assets/js/jquery-3.6.1.min.js') }}" ></script>
    <script src="{{ asset('admin_file/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_file/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin_file/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin_file/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin_file/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('admin_file/assets/js/plugins.js') }}"></script>

    <!-- particles js -->
    <script src="{{ asset('admin_file/assets/libs/particles.js/particles.js') }}"></script>
    <!-- particles app js -->
    <script src="{{ asset('admin_file/assets/js/pages/particles.app.js') }}"></script>
    <!-- validation init -->
    <script src="{{ asset('admin_file/assets/js/pages/form-validation.init.js') }}"></script>
    <!-- password create init -->
    <script src="{{ asset('admin_file/assets/js/pages/passowrd-create.init.js') }}"></script> 

    <!-- notifications init -->
    <script src="{{ asset('admin_file/assets/js/pages/notifications.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('admin_file/assets/js/app.js') }}"></script>

    <script src="{{ asset('admin_file/assets/js/main.js') }}"></script>

       
        @yield('scripts')

         
    </body>
</html>