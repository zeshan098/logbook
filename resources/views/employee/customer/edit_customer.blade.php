@extends('employee.template.admin_template')



@section('content')

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Bearbeitung {{$edit_customer->first_name}} {{$edit_customer->last_name}}</h4>
                                     
                                </div><!-- end card header -->
                                <div class="card-body">
                                     
                                    <div class="live-preview">
                                        <form method='post' id="" class="needs-validation" action="{{ url('employee/update_customer', $edit_customer->id) }}" novalidate>
                                        <input name="_token" id="token" type="hidden" value="{{ csrf_token() }}"/>
                                            <div class="row g-3">
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="first_name" value="{{$edit_customer->first_name}}" name="first_name" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Vorname</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Bitte Vornamen eingeben
                                                    </div>
                                                     
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{$edit_customer->last_name}}" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Nachname</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                         Bitte Vornamen eingeben
                                                    </div>
                                                     
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="email" class="form-control" id="email" name="email" value="{{$edit_customer->email}}" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Email</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Bitte Email eingeben
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="phone_no" name="phone_no" value="{{$edit_customer->phone_no}}" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Telefonnummer</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                         Bitte Telefonnummer eingeben
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="volume" name="volume" value="{{$edit_customer->volume}}" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Volume</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Bitte Volume eingeben
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="provision" name="provision" value="{{$edit_customer->provision}}" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Provision</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Bitte Provision eingeben
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="number" class="form-control" id="capital_income" name="capital_income" value="{{$edit_customer->capital_income}}" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Eigenkapital</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Bitte Provision Eigenkapital
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" name="chanel_id" id="chanel_id_new" aria-label="Floating label select example" required> 
                                                        <option selected>Auswählen...</option>
                                                        @foreach($chanel as $chanel)
                                                            <option value="{{$chanel->id}}" {{$edit_customer->chanel_id == $chanel->id  ? 'selected' : ''}}>{{$chanel->chanel_name}}</option> 
                                                        @endforeach  
                                                        </select>
                                                        <label for="floatingSelect">Service</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                         Bitte Service eingeben
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" name="service_id" id="service_id_new" aria-label="Floating label select example" required> 
                                                        <option value="{{$chanel_service->id}}">{{$chanel_service->service_name}}</option> 
                                                         
                                                        </select>
                                                        <label for="floatingSelect">Channel</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Bitte Channel eingeben
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" id="floatingSelect" name="status" aria-label="Floating label select example">
                                                        <option selected>Auswählen...</option>
                                                            <option {{ ($edit_customer->status) == 'Pipeline' ? 'selected' : '' }} value="Pipeline">Pipeline</option>
                                                            <option {{ ($edit_customer->status) == 'Holds' ? 'selected' : '' }} value="Holds">Holds</option>
                                                            <option {{ ($edit_customer->status) == 'Won' ? 'selected' : '' }} value="Won">Won</option>
                                                            <option {{ ($edit_customer->status) == 'Lost' ? 'selected' : '' }} value="Lost">Lost</option> 
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