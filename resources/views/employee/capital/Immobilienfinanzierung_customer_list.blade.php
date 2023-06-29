@extends('employee.template.admin_template')



@section('content')

            <div class="page-content">
                <div class="container-fluid">
                    

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0 flex-grow-1">Immobilienfinanzierung Kundeninfo</h4>
                                    <div class="col-sm-auto">
                                        <div>
                                            <button class="btn btn-primary" id="btn-excel">Export to Excel</button>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" id='search-box' class="form-control search" placeholder="Search...">
                                                        <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->
                                
                                <div class="card-body">
                                    <div class="pagination">
                                        <ol id="numbers"></ol>
                                    </div>
                                    <div class="live-preview">
                                        <div class="table-responsive">
                                            <table id="my-table" class="table align-middle table-nowrap table-striped-columns mb-0">
                                                <thead>
                                                    <tr> 
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Telefonnummer</th>
                                                        <th scope="col">Eigenkapital</th> 
                                                        <th scope="col">Aktion</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($customer_info as $customer_info)
                                                        <tr> 
                                                            <td>{{date('d.m.Y', strtotime($customer_info->date))}}</td>
                                                            <td>{{$customer_info->first_name}} {{$customer_info->last_name}}</td>
                                                            <td>{{$customer_info->email}}</td>
                                                            <td>{{$customer_info->phone_no}}</td> 
                                                            <td>{{$customer_info->capital_income}}</td> 
                                                            <td>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <button class="btn btn-info btn-sm w-100 show_activity" data-id="{{$customer_info->id}}" data-name="{{$customer_info->first_name}} {{$customer_info->last_name}}" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="ri-contacts-book-fill align-bottom me-1"></i> Aktivität</button>
                                                                 
                                                            </div>
                                                        </td>
                                                            
                                                        </tr>
                                                    @endforeach        
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
 
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                     
                   
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
                                            <input type="time" class="form-control" name="call_time" data-provider="timepickr" data-time-basic="true" id="timeInput" step="3600">
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

 
           
 <script src="{{ asset('admin_file/assets/js/table2excel.min.js') }}"></script> 
@endsection