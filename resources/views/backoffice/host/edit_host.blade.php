@extends('backoffice.template.admin_template')



@section('content')

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Edit {{$edit_host->company_name}}</h4>
                                     
                                </div><!-- end card header -->
                                <div class="card-body">
                                     
                                    <div class="live-preview">
                                        <form method='post' action="{{ url('backoffice/update_host', $edit_host->id) }}" class="needs-validation" novalidate action=" ">
                                        <input name="_token" id="token" type="hidden" value="{{ csrf_token() }}"/>
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="company_name" name="company_name" value="{{$edit_host->company_name}}" placeholder="Enter Host Name" required>
                                                        <label for="service_name">Host</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please enter Host
                                                    </div>
                                                    <div id="screenNameError"></div>
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