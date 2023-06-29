@extends('employee.template.admin_template')



@section('content')

<div class="page-content">
    <div class="container-fluid">
         
        <div class="row row-cols-xxl-5 row-cols-lg-3 row-cols-md-2 row-cols-1">
            <div class="col">
                <div class="card">
                    <a class="card-body bg-soft-danger" data-bs-toggle="collapse" href="#leadDiscovered" role="button"
                        aria-expanded="false" aria-controls="leadDiscovered">
                        <h5 class="card-title text-uppercase mb-1 fs-14">Pipeline Kunden</h5>
                        <!-- <p class="text-muted mb-0">$265,200 <span class="fw-medium">4 Deals</span></p> -->
                    </a>
                </div>
                <!--end card-->
                <div class="collapse show" id="leadDiscovered">
                    @foreach($pipeline_cust as $pipeline_cust)
                    <div class="card mb-1">
                        <div class="card-body">
                            <a class="d-flex align-items-center" data-bs-toggle="collapse" href="#leadDiscovered{{$pipeline_cust->id}}"
                                role="button" aria-expanded="false" aria-controls="leadDiscovered1">
                                <!-- <div class="flex-shrink-0">
                                    <img src="../admin_file/assets/images/users/avatar-1.jpg" alt=""
                                        class="avatar-xs rounded-circle" />
                                </div> -->
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-13 mb-1">{{$pipeline_cust->first_name}} {{$pipeline_cust->last_name}}</h6>
                                    <!-- <p class="text-muted mb-0"> {{$pipeline_cust->date}}</p> -->
                                </div>
                            </a>
                        </div>
                        <div class="collapse border-top border-top-dashed" id="leadDiscovered{{$pipeline_cust->id}}">
                            <div class="card-body">
                                <!-- <h6 class="fs-14 mb-1">Nesta Technologies <small class="badge badge-soft-danger">4
                                        Days</small></h6>
                                <p class="text-muted">As a company grows however, you find it's not as easy
                                    to shout across</p> -->
                                <ul class="list-unstyled vstack gap-2 mb-0">
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xxs text-muted">
                                                <i class="ri-mail-line"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">{{$pipeline_cust->email}}</h6>
                                                <!-- <small class="text-muted">Yesterday at 9:12AM</small> -->
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xxs text-muted">
                                                <i class="ri-phone-fill"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">{{$pipeline_cust->phone_no}}</h6>
                                                <!-- <small class="text-muted">Monday at 04:41PM</small> -->
                                            </div>
                                        </div>
                                    </li>
                                     
                                </ul>
                            </div>
                            <div class="card-footer hstack gap-2"> 
                                <a data-id="{{$pipeline_cust->id}}" data-status="Holds" class="toggle-class btn btn-warning btn-sm w-100"><i
                                        class="ri-shield-keyhole-fill align-bottom me-1"></i>Holds</a>
                                <a data-id="{{$pipeline_cust->id}}" data-status="Won" class="toggle-class btn btn-success btn-sm w-100"><i
                                        class="ri-trophy-line align-bottom me-1"></i>Won</a>
                                <a data-id="{{$pipeline_cust->id}}" data-status="Lost" class="toggle-class btn btn-danger btn-sm w-100"><i
                                        class="ri-arrow-down-line align-bottom me-1"></i>Lost</a>
                            </div>

                            <div class="card-footer hstack gap-2">
                                <a href="/employee/calender" class="btn btn-warning btn-sm w-100"><i class="ri-calendar-line align-bottom me-1"></i> Kalendar</a>
                                <button class="btn btn-info btn-sm w-100 show_activity" data-id="{{$pipeline_cust->id}}" data-name="{{$pipeline_cust->first_name}} {{$pipeline_cust->last_name}}" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="ri-contacts-book-fill align-bottom me-1"></i> Aktivität</button>
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
                        <h5 class="card-title text-uppercase mb-1 fs-14">Holds Kunden</h5>
                        <!-- <p class="text-muted mb-0">$108,700 <span class="fw-medium">5 Deals</span></p> -->
                    </a>
                </div>
                <!--end card-->
                <div class="collapse show" id="contactInitiated">
                  @foreach($hold_cust as $hold_cust)
                    <div class="card mb-1">
                         
                        <div class="card-body">
                            <a class="d-flex align-items-center" data-bs-toggle="collapse" href="#contactInitiated{{$hold_cust->id}}"
                                role="button" aria-expanded="false" aria-controls="contactInitiated{{$hold_cust->id}}">
                                <!-- <div class="flex-shrink-0">
                                    <img src="../admin_file/assets/images/users/avatar-5.jpg" alt=""
                                        class="avatar-xs rounded-circle" />
                                </div> -->
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-13 mb-1">{{$hold_cust->first_name}} {{$hold_cust->last_name}}</h6>
                                    <!-- <p class="text-muted mb-0">$28.7k - 13 Dec, 2021</p> -->
                                </div>
                            </a>
                        </div>
                        <div class="collapse border-top border-top-dashed" id="contactInitiated{{$hold_cust->id}}">
                            <div class="card-body">
                                 
                                <ul class="list-unstyled vstack gap-2 mb-0">
                                <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xxs text-muted">
                                                <i class="ri-mail-line"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">{{$hold_cust->email}}</h6>
                                                <!-- <small class="text-muted">Yesterday at 9:12AM</small> -->
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xxs text-muted">
                                                <i class="ri-phone-fill"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">{{$hold_cust->phone_no}}</h6>
                                                <!-- <small class="text-muted">Monday at 04:41PM</small> -->
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer hstack gap-2">
                                <a data-id="{{$hold_cust->id}}" data-status="Pipeline" class="toggle-class btn btn-warning btn-sm w-100"><i
                                        class="ri-space-ship-line align-bottom me-1"></i>Pipeline</a>
                                <a data-id="{{$hold_cust->id}}" data-status="Won" class="toggle-class btn btn-success btn-sm w-100"><i
                                        class="ri-trophy-line align-bottom me-1"></i>Won</a>
                                <a data-id="{{$hold_cust->id}}" data-status="Lost" class="toggle-class  btn btn-danger btn-sm w-100"><i
                                        class="ri-arrow-down-line align-bottom me-1"></i>Lost</a>
                            </div>

                            <div class="card-footer hstack gap-2">
                                <a href="/employee/calender" class="btn btn-warning btn-sm w-100"><i class="ri-calendar-line align-bottom me-1"></i> Kalendar</a>
                                <button class="btn btn-info btn-sm w-100 show_activity" data-id="{{$hold_cust->id}}" data-name="{{$hold_cust->first_name}} {{$hold_cust->last_name}}" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="ri-contacts-book-fill align-bottom me-1"></i> Aktivität</button>
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
                        <h5 class="card-title text-uppercase mb-1 fs-14">Won Kunden</h5>
                        <!-- <p class="text-muted mb-0">$708,200 <span class="fw-medium">7 Deals</span></p> -->
                    </a>
                </div>
                <!--end card-->
                <div class="collapse show" id="needsIdentified">
                    @foreach($won_cust as $won_cust)
                    <div class="card mb-1">
                        <div class="card-body">
                            <a class="d-flex align-items-center" data-bs-toggle="collapse" href="#needsIdentified{{$won_cust->id}}"
                                role="button" aria-expanded="false" aria-controls="needsIdentified{{$won_cust->id}}">
                                <!-- <div class="flex-shrink-0">
                                    <img src="../admin_file/assets/images/users/avatar-9.jpg" alt=""
                                        class="avatar-xs rounded-circle" />
                                </div> -->
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-13 mb-1">{{$won_cust->first_name}} {{$won_cust->last_name}}</h6>
                                    <!-- <p class="text-muted mb-0">$147.5k - 24 Sep, 2021</p> -->
                                </div>
                            </a>
                        </div>
                        <div class="collapse border-top border-top-dashed" id="needsIdentified{{$won_cust->id}}">
                            <div class="card-body">
                                 
                            <ul class="list-unstyled vstack gap-2 mb-0">
                                <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xxs text-muted">
                                                <i class="ri-mail-line"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">{{$won_cust->email}}</h6>
                                                <!-- <small class="text-muted">Yesterday at 9:12AM</small> -->
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xxs text-muted">
                                                <i class="ri-phone-fill"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">{{$won_cust->phone_no}}</h6>
                                                <!-- <small class="text-muted">Monday at 04:41PM</small> -->
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer hstack gap-2">
                                <a data-id="{{$won_cust->id}}" data-status="Pipeline" class="toggle-class btn btn-warning btn-sm w-100"><i
                                        class="ri-space-ship-line align-bottom me-1"></i>Pipeline</a>
                                <a data-id="{{$won_cust->id}}" data-status="Holds" class="toggle-class btn btn-success btn-sm w-100"><i
                                        class="ri-shield-keyhole-fill align-bottom me-1"></i>Holds</a>
                                <a data-id="{{$won_cust->id}}" data-status="Lost" class="toggle-class btn btn-danger btn-sm w-100"><i
                                        class="ri-arrow-down-line align-bottom me-1"></i>Lost</a>
                            </div>

                            <div class="card-footer hstack gap-2">
                                <a href="/employee/calender" class="btn btn-warning btn-sm w-100"><i class="ri-calendar-line align-bottom me-1"></i> Kalendar</a>
                                <button class="btn btn-info btn-sm w-100 show_activity" data-id="{{$won_cust->id}}"  data-name="{{$won_cust->first_name}} {{$won_cust->last_name}}"  type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="ri-contacts-book-fill align-bottom me-1"></i> Aktivität</button>
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
                    <a class="card-body bg-soft-info" data-bs-toggle="collapse" href="#meetingArranged" role="button"
                        aria-expanded="false" aria-controls="meetingArranged">
                        <h5 class="card-title text-uppercase mb-1 fs-14">Lost Kunden</h5>
                        <!-- <p class="text-muted mb-0">$44,900 <span class="fw-medium">3 Deals</span></p> -->
                    </a>
                </div>
                <!--end card-->
                <div class="collapse show" id="meetingArranged">
                    @foreach($lost_cust as $lost_cust)
                    <div class="card mb-1">
                        <div class="card-body">
                            <a class="d-flex align-items-center" data-bs-toggle="collapse" href="#meetingArranged{{$lost_cust->id}}"
                                role="button" aria-expanded="false" aria-controls="meetingArranged{{$lost_cust->id}}">
                                <!-- <div class="flex-shrink-0">
                                    <img src="../admin_file/assets/images/companies/img-5.png" alt=""
                                        class="avatar-xs rounded-circle" />
                                </div> -->
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-13 mb-1">{{$lost_cust->first_name}} {{$lost_cust->last_name}}</h6>
                                    <!-- <p class="text-muted mb-0">$17.8k - 01 Jan, 2022</p> -->
                                </div>
                            </a>
                        </div>
                        <div class="collapse border-top border-top-dashed" id="meetingArranged{{$lost_cust->id}}">
                            <div class="card-body">
                                
                            <ul class="list-unstyled vstack gap-2 mb-0">
                                <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xxs text-muted">
                                                <i class="ri-mail-line"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">{{$lost_cust->email}}</h6>
                                                <!-- <small class="text-muted">Yesterday at 9:12AM</small> -->
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xxs text-muted">
                                                <i class="ri-phone-fill"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">{{$lost_cust->phone_no}}</h6>
                                                <!-- <small class="text-muted">Monday at 04:41PM</small> -->
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer hstack gap-2">
                                <a data-id="{{$lost_cust->id}}" data-status="Pipeline" class="toggle-class btn btn-warning btn-sm w-100"><i
                                        class="ri-space-ship-line align-bottom me-1"></i>Pipeline</a>
                                <a data-id="{{$lost_cust->id}}" data-status="Won" class="toggle-class btn btn-success btn-sm w-100"><i
                                        class="ri-trophy-line align-bottom me-1"></i>Won</a>
                                <a data-id="{{$lost_cust->id}}" data-status="Holds" class="toggle-class btn btn-danger btn-sm w-100"><i
                                        class="ri-shield-keyhole-fill align-bottom me-1"></i>Hold</a>
                            </div>

                            <div class="card-footer hstack gap-2">
                                <a href="/employee/calender" class="btn btn-warning btn-sm w-100"><i class="ri-calendar-line align-bottom me-1"></i> Kalendar</a>
                                <a class="btn btn-info btn-sm w-100 show_activity" data-id="{{$lost_cust->id}}"   data-name="{{$lost_cust->first_name}} {{$lost_cust->last_name}}"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="ri-contacts-book-fill align-bottom me-1"></i> Aktivität</a>
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
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Anruftyp</label>
                                <select id="call_type" name="call_type" class="form-select">
                                    <option selected>Choose...</option>
                                    <option value="Cold Call">Cold Call</option>
                                    <option value="Setting Call">Setting Call</option>
                                    <option value="Opening Call">Opening Call</option>
                                    <option value="Closing Call">Closing Call</option>
                                    <option value="Followup Call">Followup Call</option>
                                </select>
                            </div>
                        </div><!--end col-->
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Anrufergebnis</label>
                                <select id="call_result" name="call_result" class="form-select">
                                    <option selected>Choose...</option>
                                    <option value="Nicht erreicht">Nicht erreicht</option>
                                    <option value="Setting Call">Erreicht</option>
                                    <option value="Teilnehmer besetzt">Teilnehmer besetzt</option>
                                    <option value="Falscher Nummer">Falscher Nummer</option> 
                                </select>
                            </div>
                        </div><!--end col-->

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Datum</label>
                                <input type="date" class="form-control" name="call_date" data-provider="flatpickr" id="StartleaveDate">
                            </div>
                        </div><!--end col-->
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Zeit</label>
                                <input type="time" class="form-control" name="call_time" data-provider="timepickr" data-time-basic="true" id="timeInput">
                            </div>
                        </div><!--end col-->
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Beschreibung</label>
                                <textarea class="form-control" name="msg" id="meassageInput" rows="3" placeholder=""></textarea>
                            </div>
                        </div><!--end col-->
                        <div class="text-end">
                            <button type="submit" id="add_activity" class="btn btn-primary">Erstellen</button>
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