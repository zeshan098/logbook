@extends('employee.template.admin_template')



@section('content')

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Bearbeitung   {{$edit_service->service_name}}</h4>
                                     
                                </div><!-- end card header -->
                                <div class="card-body">
                                     
                                    <div class="live-preview">
                                        <form method='post'  action="{{ url('employee/update_service', $edit_service->id) }}" class="needs-validation" novalidate>
                                        <input name="_token" id="token" type="hidden" value="{{ csrf_token() }}"/>
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="service_name" name="service_name" value="{{$edit_service->service_name}}" placeholder="Enter your Channel Name" required>
                                                        <label for="service_name">Channelname</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Bitte geben Sie einen Channelnamen ein
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-floating">
                                                        <select class="form-select" name="chanel_id" id="chanel_id" aria-label="Floating label select example" require> 
                                                        <option selected>Auswählen...</option>
                                                        @foreach($chanel as $chanel)
                                                            <option value="{{$chanel->id}}" {{$edit_service->chanel_id == $chanel->id  ? 'selected' : ''}}>{{$chanel->chanel_name}}</option> 
                                                        @endforeach  
                                                        </select>
                                                        <label for="floatingSelect">Service</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="color" name="txt_colr" value="{{$edit_service->bg_colr}}" id="colorPicker">
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