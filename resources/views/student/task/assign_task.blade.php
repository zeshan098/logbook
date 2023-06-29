@extends('student.template.admin_template')



@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Task List</h4>

                     

                </div>
            </div>
        </div>
         
        <div class="row row-cols-xxl-5 row-cols-lg-3 row-cols-md-2 row-cols-1">
            <div class="col">
                <div class="card">
                    <a class="card-body bg-soft-danger" data-bs-toggle="collapse" href="#leadDiscovered" role="button"
                        aria-expanded="false" aria-controls="leadDiscovered">
                        <h5 class="card-title text-uppercase mb-1 fs-14">TO Do</h5>
                        <!-- <p class="text-muted mb-0">$265,200 <span class="fw-medium">4 Deals</span></p> -->
                    </a>
                </div>
                <!--end card-->
                <div class="collapse show" id="leadDiscovered">
                    @foreach($to_task as $to_task)
                        <div class="card mb-1">
                            <div class="card-body">
                                <a class="d-flex align-items-center" data-bs-toggle="collapse" href="#leadDiscovered{{$to_task->id}}"
                                    role="button" aria-expanded="false" aria-controls="leadDiscovered1">
                                    <!-- <div class="flex-shrink-0">
                                        <img src="../admin_file/assets/images/users/avatar-1.jpg" alt=""
                                            class="avatar-xs rounded-circle" />
                                    </div> -->
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-13 mb-1">{{$to_task->task_name}}</h6>
                                        
                                    </div>
                                </a>
                            </div>
                            <div class="collapse border-top border-top-dashed" id="leadDiscovered{{$to_task->id}}">
                                <div class="card-body">
                                    <h6 class="fs-14 mb-1">{{$to_task->task_name}}</h6>
                                    <p class="text-muted">{!!$to_task->task_detail!!}</p>
                                    <ul class="list-unstyled vstack gap-2 mb-0">
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 avatar-xxs text-muted">
                                                    <i class="ri-calendar-line"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">Start Date - End Date</h6>
                                                    <small class="text-muted">{{$to_task->start_date}} - {{$to_task->end_date}}</small>
                                                </div>
                                            </div>
                                        </li>
                                        
                                        
                                    </ul>
                                </div>
                                <div class="card-footer hstack gap-2"> 
                                    <button class="btn btn-info btn-sm w-100 show_activity" data-id="{{$to_task->id}}" data-name="{{$to_task->task_name}}" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="ri-contacts-book-fill align-bottom me-1"></i> Activity or  Duties</button>
                                    
                                </div>

                                
                            </div>
                        </div>
                    @endforeach 
                    <!--end card-->  
                </div>
            </div>
            <!--end col-->

            <div class="col">
                <div class="card">
                    <a class="card-body bg-soft-success" data-bs-toggle="collapse" href="#contactInitiated"
                        role="button" aria-expanded="false" aria-controls="contactInitiated">
                        <h5 class="card-title text-uppercase mb-1 fs-14">In Progress</h5>
                        <!-- <p class="text-muted mb-0">$108,700 <span class="fw-medium">5 Deals</span></p> -->
                    </a>
                </div>
                <!--end card-->
                <div class="collapse show" id="contactInitiated">
                    @foreach($in_progress_task as $in_progress_task)
                        <div class="card mb-1">
                            <div class="card-body">
                                <a class="d-flex align-items-center" data-bs-toggle="collapse" href="#leadDiscovered{{$in_progress_task->id}}"
                                    role="button" aria-expanded="false" aria-controls="leadDiscovered1">
                                    <!-- <div class="flex-shrink-0">
                                        <img src="../admin_file/assets/images/users/avatar-1.jpg" alt=""
                                            class="avatar-xs rounded-circle" />
                                    </div> -->
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-13 mb-1">{{$in_progress_task->task_name}}</h6>
                                        
                                    </div>
                                </a>
                            </div>
                            <div class="collapse border-top border-top-dashed" id="leadDiscovered{{$in_progress_task->id}}">
                                <div class="card-body">
                                    <h6 class="fs-14 mb-1">{{$in_progress_task->task_name}}</h6>
                                    <p class="text-muted">{!!$in_progress_task->task_detail!!}</p>
                                    <ul class="list-unstyled vstack gap-2 mb-0">
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 avatar-xxs text-muted">
                                                    <i class="ri-calendar-line"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">Start Date - End Date</h6>
                                                    <small class="text-muted">{{$in_progress_task->start_date}} - {{$in_progress_task->end_date}}</small>
                                                </div>
                                            </div>
                                        </li>
                                        
                                        
                                    </ul>
                                </div>
                                <div class="card-footer hstack gap-2"> 
                                    <button class="btn btn-info btn-sm w-100 show_activity" data-id="{{$in_progress_task->id}}" data-status="{{$in_progress_task->status}}" data-name="{{$in_progress_task->task_name}}" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="ri-contacts-book-fill align-bottom me-1"></i> Activity or  Duties</button>
                                    
                                </div>

                                
                            </div>
                        </div>
                    @endforeach 
                    <!--end card--> 
 
                </div>
            </div>
            <!--end col-->

            <div class="col">
                <div class="card">
                    <a class="card-body bg-soft-warning" data-bs-toggle="collapse" href="#needsIdentified" role="button"
                        aria-expanded="false" aria-controls="needsIdentified">
                        <h5 class="card-title text-uppercase mb-1 fs-14">Complete</h5>
                        <!-- <p class="text-muted mb-0">$708,200 <span class="fw-medium">7 Deals</span></p> -->
                    </a>
                </div>
                <!--end card-->
                <div class="collapse show" id="needsIdentified">
                    @foreach($complete_task as $complete_task)
                        <div class="card mb-1">
                            <div class="card-body">
                                <a class="d-flex align-items-center" data-bs-toggle="collapse" href="#leadDiscovered{{$complete_task->id}}"
                                    role="button" aria-expanded="false" aria-controls="leadDiscovered1">
                                    <!-- <div class="flex-shrink-0">
                                        <img src="../admin_file/assets/images/users/avatar-1.jpg" alt=""
                                            class="avatar-xs rounded-circle" />
                                    </div> -->
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-13 mb-1">{{$complete_task->task_name}}</h6>
                                        
                                    </div>
                                </a>
                            </div>
                            <div class="collapse border-top border-top-dashed" id="leadDiscovered{{$complete_task->id}}">
                                <div class="card-body">
                                    <h6 class="fs-14 mb-1">{{$complete_task->task_name}}</h6>
                                    <p class="text-muted">{!!$complete_task->task_detail!!}</p>
                                    <ul class="list-unstyled vstack gap-2 mb-0">
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 avatar-xxs text-muted">
                                                    <i class="ri-calendar-line"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">Start Date - End Date</h6>
                                                    <small class="text-muted">{{$complete_task->start_date}} - {{$complete_task->end_date}}</small>
                                                </div>
                                            </div>
                                        </li>
                                        
                                        
                                    </ul>
                                </div>
                                <!-- <div class="card-footer hstack gap-2"> 
                                    <button class="btn btn-info btn-sm w-100 show_activity" data-id="{{$complete_task->id}}" data-name="{{$complete_task->task_name}}" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="ri-contacts-book-fill align-bottom me-1"></i> Activity or  Duties</button>
                                    
                                </div> -->

                                
                            </div>
                        </div>
                    @endforeach 
                    <!--end card--> 
                </div>
            </div>
            <!--end col-->

             
            
 
        </div>
        <!--end row-->

         <!-- right offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header border-bottom">
                <h5 id="customer_name"></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form method='post' id="my-form" action='' enctype="multipart/form-data"> 
                    <input type="hidden" id="token"  name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="cust_id" class="pop_id" value="">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Status</label>
                                <select id="call_type" name="call_type" class="form-select task_status">
                                    <option value="" selected>Choose...</option> 
                                    <option value="in_progress">In Progress</option>
                                    <option value="complete">Complete</option>  
                                </select>
                            </div>
                        </div><!--end col-->
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Start Time</label>
                                <input type="time" name="start_time" id="start_time" class="form-control"  >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">End Time</label>
                                <input type="time" name="end_time" id="end_time" class="form-control"  >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Activity or Duties</label>
                                <textarea class="form-control" name="msg" id="meassageInput" rows="3" placeholder=""></textarea>
                            </div>
                        </div><!--end col-->
                        <div class="text-end">
                            <button type="submit" id="add_activity" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </form>

                <div class="acitivity-timeline" id="bodyData">
                     
                     
                </div>
            </div>
            
        </div>


    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
 
@endsection

 