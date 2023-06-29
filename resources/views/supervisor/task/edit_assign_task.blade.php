@extends('supervisor.template.admin_template')



@section('content')

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Assign Task</h4>
                                     
                                </div><!-- end card header -->
                                <div class="card-body">
                                     
                                    <div class="live-preview">
                                        <form method='post' action="{{ url('supervisor/update_assign_task', $edit_assign_task->id) }}" class="needs-validation" novalidate action=" ">
                                        <input name="_token" id="token" type="hidden" value="{{ csrf_token() }}"/>
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div class="form-floating">
                                                        <select class="form-select" name="assign_to" id="assign_to" aria-label="Floating label select example" require> 
                                                        <option selected>Select Student</option>
                                                        @foreach($student as $student)
                                                            <option value="{{$student->st_id}}" {{$edit_assign_task->assign_to == $student->st_id  ? 'selected' : ''}}>{{$student->student_name}}</option> 
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
                                                        <input type="date" class="form-control" id="start_date" value="{{$edit_assign_task->start_date}}" name="start_date" placeholder=" " required>
                                                        <label for="no_of_cust">Start Date</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Start Date
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" id="end_date" value="{{$edit_assign_task->end_date}}" name="end_date" placeholder=" " required>
                                                        <label for="no_of_cust">End Date</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                          End Date
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="task_name" value="{{$edit_assign_task->task_name}}" name="task_name" placeholder=" " required>
                                                        <label for="no_of_cust">Task Name</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                       Task Name
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-floating">
                                                        <textarea class="form-control" name="task_detail" id="task_detail" rows="9">{!!$edit_assign_task->task_detail!!}</textarea>
                                                        <label for="no_of_cust">Task Detail</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                       Task Detail
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" name="status" id="floatingSelect" aria-label="Floating label select example" require> 
                                                        <option selected>Select Status</option> 
                                                            <option {{ ($edit_assign_task->status) == 'to_do' ? 'selected' : '' }} value="to_do">TO DO</option> 
                                                            <option {{ ($edit_assign_task->status) == 'in_progress' ? 'selected' : '' }} value="in_progress">In Progress</option> 
                                                            <option {{ ($edit_assign_task->status) == 'complete' ? 'selected' : '' }} value="complete">Complete</option> 
                                                            <option {{ ($edit_assign_task->status) == 'approved' ? 'selected' : '' }} value="approved">Approved</option>
                                                            <option {{ ($edit_assign_task->status) == 'dis_approved' ? 'selected' : '' }} value="dis_approved">Disapproved</option>  
                                                        </select>
                                                        <label for="floatingSelect">Status</label>
                                                        <div class="invalid-feedback">
                                                            Select Status
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                                 
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit"   class="btn btn-primary">Update</button>
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