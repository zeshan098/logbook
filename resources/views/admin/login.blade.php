
@extends('admin.template.login_form')

@section('content')

<!-- auth page content -->
<div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center  mb-4 text-white-50">
                            <div>
                                <!-- <a href="/" class="d-inline-block auth-logo">
                                    <img src="../../admin_file/assets/images/logo.png" alt=""  >
                                </a> -->
                            </div>
                             
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-danger">Login Please !</h5> 
                                </div>
                                <div class="p-2 mt-4">
                                <form method='post' id="login_form" action=''>
                                <input name="_token" id="token" type="hidden" value="{{ csrf_token() }}"/>

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" placeholder="Enter username">
                                        </div>

                                        <div class="mb-3">
                                          
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                      
                                        
                                        <div class="mt-4">
                                            <button class="btn btn-danger w-100" id="cust_login" type="submit">Sign In</button>
                                        </div>

                                         
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                         

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->


@endsection

 
 