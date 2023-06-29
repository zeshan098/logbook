@extends('supervisor.template.admin_template')



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
                        <h5 class="card-title text-uppercase mb-1 fs-14">Complete Task</h5>
                        <!-- <p class="text-muted mb-0">$265,200 <span class="fw-medium">4 Deals</span></p> -->
                    </a>
                </div>
                <!--end card-->
                <div class="collapse show" id="leadDiscovered">
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
                                        <h6 class="fs-13 mb-1">{{$complete_task->student_name}}</h6>
                                        
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
                                <div class="card-footer hstack gap-2"> 
                                    <button class="btn btn-info btn-sm w-100 show_activity_super" data-id="{{$complete_task->id}}" data-status="{{$complete_task->status}}" data-name="{{$complete_task->task_name}}" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="ri-contacts-book-fill align-bottom me-1"></i> Activity</button>
                                    
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
                        <h5 class="card-title text-uppercase mb-1 fs-14">Approved Task</h5>
                        <!-- <p class="text-muted mb-0">$108,700 <span class="fw-medium">5 Deals</span></p> -->
                    </a>
                </div>
                <!--end card-->
                <div class="collapse show" id="contactInitiated">
                    @foreach($approved_task as $approved_task)
                        <div class="card mb-1">
                            <div class="card-body">
                                <a class="d-flex align-items-center" data-bs-toggle="collapse" href="#leadDiscovered{{$approved_task->id}}"
                                    role="button" aria-expanded="false" aria-controls="leadDiscovered1">
                                    <!-- <div class="flex-shrink-0">
                                        <img src="../admin_file/assets/images/users/avatar-1.jpg" alt=""
                                            class="avatar-xs rounded-circle" />
                                    </div> -->
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-13 mb-1">{{$approved_task->student_name}}</h6>
                                        
                                    </div>
                                </a>
                            </div>
                            <div class="collapse border-top border-top-dashed" id="leadDiscovered{{$approved_task->id}}">
                                <div class="card-body">
                                    <h6 class="fs-14 mb-1">{{$approved_task->task_name}}</h6>
                                    <p class="text-muted">{!!$approved_task->task_detail!!}</p>
                                    <ul class="list-unstyled vstack gap-2 mb-0">
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 avatar-xxs text-muted">
                                                    <i class="ri-calendar-line"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">Start Date - End Date</h6>
                                                    <small class="text-muted">{{$approved_task->start_date}} - {{$approved_task->end_date}}</small>
                                                </div>
                                            </div>
                                        </li>
                                        
                                        
                                    </ul>
                                </div>
                                <div class="card-footer hstack gap-2"> 
                                    <button class="btn btn-info btn-sm w-100 show_activity_super" data-id="{{$approved_task->id}}" data-status="{{$approved_task->status}}" data-name="{{$approved_task->task_name}}" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="ri-contacts-book-fill align-bottom me-1"></i> Activity</button>
                                    
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
                        <h5 class="card-title text-uppercase mb-1 fs-14">Disapproved Task</h5>
                        <!-- <p class="text-muted mb-0">$708,200 <span class="fw-medium">7 Deals</span></p> -->
                    </a>
                </div>
                <!--end card-->
                <div class="collapse show" id="needsIdentified">
                    @foreach($dis_approved_task as $dis_approved_task)
                        <div class="card mb-1">
                            <div class="card-body">
                                <a class="d-flex align-items-center" data-bs-toggle="collapse" href="#leadDiscovered{{$dis_approved_task->id}}"
                                    role="button" aria-expanded="false" aria-controls="leadDiscovered1">
                                    <!-- <div class="flex-shrink-0">
                                        <img src="../admin_file/assets/images/users/avatar-1.jpg" alt=""
                                            class="avatar-xs rounded-circle" />
                                    </div> -->
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-13 mb-1">{{$dis_approved_task->student_name}}</h6>
                                        
                                    </div>
                                </a>
                            </div>
                            <div class="collapse border-top border-top-dashed" id="leadDiscovered{{$dis_approved_task->id}}">
                                <div class="card-body">
                                    <h6 class="fs-14 mb-1">{{$dis_approved_task->task_name}}</h6>
                                    <p class="text-muted">{!!$dis_approved_task->task_detail!!}</p>
                                    <ul class="list-unstyled vstack gap-2 mb-0">
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 avatar-xxs text-muted">
                                                    <i class="ri-calendar-line"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">Start Date - End Date</h6>
                                                    <small class="text-muted">{{$dis_approved_task->start_date}} - {{$dis_approved_task->end_date}}</small>
                                                </div>
                                            </div>
                                        </li>
                                        
                                        
                                    </ul>
                                </div>
                                <div class="card-footer hstack gap-2"> 
                                    <button class="btn btn-info btn-sm w-100 show_activity_super" data-id="{{$dis_approved_task->id}}" data-status="{{$dis_approved_task->status}}" data-name="{{$dis_approved_task->task_name}}" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="ri-contacts-book-fill align-bottom me-1"></i> Activity</button>
                                    
                                </div>
                               

                                
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
                                    <option selected>Choose...</option>
                                    <option value="complete">Complete</option>
                                    <option value="approved">Approved</option>
                                    <option value="dis_approved">Disapproved</option>  
                                </select>
                            </div>
                        </div><!--end col-->
                         
                         
                        <div class="text-end">
                            <button type="submit" id="super_task_activity" class="btn btn-primary">Submit</button>
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

 