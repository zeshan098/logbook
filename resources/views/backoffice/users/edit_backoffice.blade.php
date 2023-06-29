@extends('backoffice.template.admin_template')



@section('content')

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Edit {{$edit_user->name}}</h4>
                                     
                                </div><!-- end card header -->
                                <div class="card-body">
                                     
                                    <div class="live-preview">
                                        <form method='post' action="{{ url('backoffice/update_backoffice',$edit_user->id) }}" class="needs-validation" novalidate  >
                                        <input name="_token" id="token" type="hidden" value="{{ csrf_token() }}"/>
                                            <div class="row g-3">
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" value="{{$edit_user->name}}" name="name" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Name</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please enter Name
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" value="{{$edit_user->username}}" name="username" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Username</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please enter username
                                                    </div>
                                                    <div id="screenNameError"></div> 
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="email" class="form-control" id="useremail" value="{{$edit_user->email}}" name="email" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Email</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please enter Email
                                                    </div>
                                                    <div id="screenNameError"></div> 
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="password" class="form-control" value="{{$edit_user->password}}" name="password" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Password</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please enter Password
                                                    </div>
                                                </div>
                                                 

                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" name="status" id="floatingSelect" aria-label="Floating label select example" require> 
                                                            <option selected>Choose...</option> 
                                                            <option {{ ($edit_user->status) == 'open' ? 'selected' : '' }} value="open">Open</option> 
                                                            <option {{ ($edit_user->status) == 'close' ? 'selected' : '' }} value="close">Close</option> 
                                                        </select>
                                                        <label for="floatingSelect">Status</label>
                                                    </div>
                                                </div>
                                                 
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" id="" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                     
                                </div>
                            </div>
                        </div>
                    </div>

                    
                     

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

 
            
@endsection