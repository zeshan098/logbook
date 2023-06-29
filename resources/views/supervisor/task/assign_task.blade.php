@extends('supervisor.template.admin_template')



@section('content')

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Assign Task</h4>
                                     
                                </div><!-- end card header -->
                                <div class="card-body">
                                     
                                    <div class="live-preview">
                                        <form method='post' id="add_task_info" class="needs-validation" novalidate action=" ">
                                        <input name="_token" id="token" type="hidden" value="{{ csrf_token() }}"/>
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div class="form-floating">
                                                        <select class="form-select" name="assign_to" id="assign_to" aria-label="Floating label select example" require> 
                                                        <option selected>Select Student</option>
                                                        @foreach($assignedUsers as $assignedUsers)
                                                            <option value="{{$assignedUsers->st_id}}">{{$assignedUsers->student_name}}</option> 
                                                        @endforeach  
                                                        </select>
                                                        <label for="floatingSelect">Student</label>
                                                        <div class="invalid-feedback">
                                                            Select Student
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" id="start_date" name="start_date" placeholder=" " required>
                                                        <label for="no_of_cust">Start Date</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Start Date
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" id="end_date" name="end_date" placeholder=" " required>
                                                        <label for="no_of_cust">End Date</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                          End Date
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="task_name" name="task_name" placeholder=" " required>
                                                        <label for="no_of_cust">Task Name</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                       Task Name
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-floating">
                                                        <textarea class="form-control" name="task_detail" id="task_detail" rows="3"></textarea>
                                                        <label for="no_of_cust">Task Detail</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                       Task Detail
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" id="floatingSelect" name="status" aria-label="Floating label select example">
                                                        <option selected>Select Status</option> 
                                                            <option value="to_do">TO DO</option> 
                                                            <option value="in_progress">In Progress</option> 
                                                            <option value="complete">Complete</option> 
                                                        </select>
                                                        <label for="floatingSelect">Status</label>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                 
                                                 
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" id="assign_task" class="btn btn-primary">Submit</button>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Task List</h4>
                                     
                                </div><!-- end card header -->

                                <div class="card-body">
                                    
                                    <div class="live-preview">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                         
                                                        <th scope="col">Task Name</th>  
                                                        <th scope="col">Start Date</th> 
                                                        <th scope="col">End Date</th> 
                                                        <th scope="col">Assign To</th> 
                                                        <th scope="col">Status</th> 
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($assigned_task as $assigned_task)
                                                    <tr>
                                                         
                                                        <td class="chanel_name">{{$assigned_task->task_name}}</td> 
                                                        <td class="chanel_name">{{$assigned_task->start_date}}</td> 
                                                        <td class="chanel_name">{{$assigned_task->end_date}}</td> 
                                                        <td class="chanel_name">{{$assigned_task->student_name}}</td> 
                                                        @if($assigned_task->status == 'to_do')
                                                        <td class="chanel_name">To Do</td> 
                                                        @elseif($assigned_task->status == 'in_progress')
                                                        <td class="chanel_name">In Progress</td>  
                                                        @elseif($assigned_task->status == 'approved')
                                                        <td class="chanel_name">Approved</td>  
                                                        @elseif($assigned_task->status == 'dis_approved')
                                                        <td class="chanel_name">Disapproved</td> 
                                                        @else 
                                                        <td class="chanel_name">Complete</td>  
                                                        @endif
                                                        <td>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <a  href="/supervisor/edit-assign-task/{{$assigned_task->id}}" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                                                <a data-id="{{$assigned_task->id}}" data-bs-toggle="modal" data-bs-target="#deleteTaskModal" class="link-danger delete_assign_task fs-15"><i class="ri-delete-bin-line"></i></a>
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
<div class="modal fade zoomIn" id="deleteTaskModal" tabindex="-1" aria-hidden="true">
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
                                        <button type="button" class="btn w-sm btn-danger " id="delete-assign-task">Yes, Delete It!</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end modal -->
            
@endsection