@extends('backoffice.template.admin_template')



@section('content')

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Activity Report</h4>
                                     
                                </div><!-- end card header -->
                                <div class="card-body">
                                     
                                    <div class="live-preview">
                                        <form method="POST" action="{{ url('backoffice/report/get_activity_report') }}" class="form">
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                            <div class="row g-3">
                                                
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
                                                        <select class="form-select" name="assign_to" id="assign_to" aria-label="Floating label select example" require> 
                                                        <option selected>Select Student</option>
                                                        @foreach($student as $student)
                                                            <option value="{{$student->id}}">{{$student->name}}</option> 
                                                        @endforeach  
                                                        </select>
                                                        <label for="floatingSelect">Student</label>
                                                        <div class="invalid-feedback">
                                                            Select Student
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                                 
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <button type="submit" id="assign_host" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                     
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(isset($user_detail)) 

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Activity Report</h4>
                                    <form class="row g-3 needs-validation" role="form" action="{{ url('/backoffice/report/pdf_activity_report') }}" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                        <input type="hidden" class="form-control from_date" value="{{$start_date}}" name="from_date" required>
                                        <input type="hidden" class="form-control from_date" value="{{$end_date}}" name="end_date" required>
                                        <input type="hidden" class="form-control assign_to" value="{{$assign_to}}" name="assign_to" required>
                                        <button class="btn btn-danger w-100" type="submit">Download PDF</button>
                                    </form>
                                </div><!-- end card header -->
                                <div class="col-xxl-3">
                                    <div class="card" id="company-view-detail">
                                        
                                        <div class="card-body">
                                            
                                            <div class="table-responsive table-card">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="fw-medium" scope="row">Name</td>
                                                            <td>{{$user_detail->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium" scope="row">Host</td>
                                                            <td>{{$user_detail->company_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium" scope="row">Vocation</td>
                                                            <td>{{$user_detail->vocation}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium" scope="row">College</td>
                                                            <td>{{$user_detail->college}}</td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!--end card-->
                        </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <!-- <h4 class="card-title mb-0 flex-grow-1">Task List</h4> -->
                                     
                                </div><!-- end card header -->

                                <div class="card-body">
                                    
                                    <div class="live-preview">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                         
                                                           
                                                        <th scope="col">Start Date</th> 
                                                        <th scope="col">End Date</th> 
                                                        <th scope="col">Activity or Duties</th>  
                                                        <th scope="col">Complete Date</th>    
                                                        <th scope="col">Hours</th>  
                                                        <th scope="col">Status</th>  
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($activity_detail as $activity_detail)
                                                    <tr>
                                                         
                                                        <td class="chanel_name">{{date('d-m-Y', strtotime($activity_detail->start_date))}}</td> 
                                                        <td class="chanel_name">{{date('d-m-Y', strtotime($activity_detail->end_date))}}</td> 
                                                        <td class="chanel_name">{{$activity_detail->remarks}}</td> 
                                                        <td class="chanel_name">{{date('d-m-Y', strtotime($activity_detail->complete_date))}}</td>
                                                        <td class="chanel_name">{{$activity_detail->total_hours}}</td>
                                                        @if($activity_detail->status == 'to_do')
                                                        <td class="chanel_name">To Do</td> 
                                                        @elseif($activity_detail->status == 'in_progress')
                                                        <td class="chanel_name">In Progress</td>  
                                                        @elseif($activity_detail->status == 'approved')
                                                        <td class="chanel_name">Approved</td>  
                                                        @elseif($activity_detail->status == 'dis_approved')
                                                        <td class="chanel_name">Disapproved</td> 
                                                        @else 
                                                        <td class="chanel_name">Complete</td>  
                                                        @endif 
                                                        
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
                    @endif

                     

                </div>
                <!-- container-fluid -->
            </div>
             
@endsection