@extends('backoffice.template.admin_template')



@section('content')

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Assign User</h4>
                                     
                                </div><!-- end card header -->
                                <div class="card-body">
                                     
                                    <div class="live-preview">
                                        <form method='post' id="add_user_info" class="needs-validation" novalidate action=" ">
                                        <input name="_token" id="token" type="hidden" value="{{ csrf_token() }}"/>
                                            <div class="row g-3">
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" name="supervisor_id" id="supervisor_id" aria-label="Floating label select example" require> 
                                                        <option selected>Select Supervisor</option>
                                                        @foreach($supervisor as $supervisor)
                                                            <option value="{{$supervisor->id}}">{{$supervisor->name}}</option> 
                                                        @endforeach  
                                                        </select>
                                                        <label for="floatingSelect">Supervisor</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" name="student_id" id="student_id" aria-label="Floating label select example" require> 
                                                        <option selected>Select Student</option>
                                                        @foreach($student as $student)
                                                            <option value="{{$student->id}}">{{$student->name}}</option> 
                                                        @endforeach  
                                                        </select>
                                                        <label for="floatingSelect">Student</label>
                                                    </div>
                                                </div>
                                                 
                                                 
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" id="assign_user" class="btn btn-primary">Submit</button>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Assign List</h4>
                                     
                                </div><!-- end card header -->

                                <div class="card-body">
                                    
                                    <div class="live-preview">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                         
                                                        <th scope="col">Supervisor</th> 
                                                        <th scope="col">Student</th>  
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($assignedUsers as $assignedUsers)
                                                    <tr>
                                                         
                                                        <td class="chanel_name">{{$assignedUsers->supervisor_name}}</td>
                                                        <td class="chanel_name">{{$assignedUsers->student_name}}</td> 
                                                        <td>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <a  href="/backoffice/edit-assign-user/{{$assignedUsers->id}}" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                                                <a data-id="{{$assignedUsers->id}}" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" class="link-danger delete_assign_user fs-15"><i class="ri-delete-bin-line"></i></a>
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
<div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
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
                                        <button type="button" class="btn w-sm btn-danger " id="delete-assign-record">Yes, Delete It!</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end modal -->
            
@endsection