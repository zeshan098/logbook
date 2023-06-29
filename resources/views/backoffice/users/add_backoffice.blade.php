@extends('backoffice.template.admin_template')



@section('content')

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add Backoffice</h4>
                                     
                                </div><!-- end card header -->
                                <div class="card-body">
                                     
                                    <div class="live-preview">
                                        <form method='post' id="add_backoffice_info" class="needs-validation" novalidate action=" ">
                                        <input name="_token" id="token" type="hidden" value="{{ csrf_token() }}"/>
                                            <div class="row g-3">
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Name</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please enter Name
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Username</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please enter username
                                                    </div>
                                                    <div id="screenNameError"></div> 
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="email" class="form-control" id="useremail" name="email" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Email</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please enter Email
                                                    </div>
                                                    <div id="screenNameError"></div> 
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Password</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please enter Password
                                                    </div>
                                                </div>  
                                                
                                                 
                                                 
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" id="create_backoffice" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                     
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">User List</h4>
                                     
                                </div><!-- end card header -->

                                <div class="card-body">
                                    
                                    <div class="live-preview">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                         
                                                        <th scope="col">Name</th> 
                                                        <th scope="col">Username</th> 
                                                        <th scope="col">Email</th>  
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($user_list as $user_list)
                                                    <tr>
                                                         
                                                        <td class="chanel_name">{{$user_list->name}}</td>
                                                        <td class="chanel_name">{{$user_list->username}}</td>
                                                        <td class="chanel_name">{{$user_list->email}}</td> 
                                                        <td>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <a  href="/backoffice/edit_backoffice/{{$user_list->id}}" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                                                
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach   
                                                    
                                                </tbody>
                                                 
                                            </table>
                                            <!-- end table -->
                                        </div>
                                        <!-- end table responsive -->
                                    </div>
                                     
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div>
                    <!--end row-->
                     

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

<!-- Modal -->
<div class="modal fade zoomIn" id="deleteServiceRecordModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                </div>
                                <form method='post' id="chanel-service-form" action='' enctype="multipart/form-data"> 
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="modal-body">
                                        <div class="mb-3" id="modal-id" style="display: none;">
                                            <label for="service-id-field" class="form-label">ID</label>
                                            <input type="text" id="del-service-field" name="id" class="form-control" placeholder="ID" readonly />
                                        </div>
                                    <div class="mt-2 text-center">
                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                            <h4>Are you Sure ?</h4>
                                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn w-sm btn-danger " id="delete-service-record">Yes, Delete It!</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end modal -->
            
@endsection