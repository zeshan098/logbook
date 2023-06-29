@extends('employee.template.admin_template')



@section('content')

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Channel-Service Hinzufügen</h4>
                                     
                                </div><!-- end card header -->
                                <div class="card-body">
                                     
                                    <div class="live-preview">
                                        <form method='post' id="chanel_service_create" class="needs-validation" novalidate action=" ">
                                        <input name="_token" id="token" type="hidden" value="{{ csrf_token() }}"/>
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Enter your Channel Name" required>
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
                                                            <option value="{{$chanel->id}}">{{$chanel->chanel_name}}</option> 
                                                        @endforeach  
                                                        </select>
                                                        <label for="floatingSelect">Service</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        
                                                        <input type="color" name="txt_colr" value="#000000" id="colorPicker">

                                                        
                                                        <!-- <label for="floatingSelect">--Select Color--</label> -->
                                                    </div>
                                                </div>
                                                 
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" id="chanel_service_create_btn" class="btn btn-primary">Absenden</button>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Channel-Service-Listen</h4>
                                     
                                </div><!-- end card header -->

                                <div class="card-body">
                                    
                                    <div class="live-preview">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                         
                                                        <th scope="col">Channelname</th> 
                                                        <th scope="col">Servicename</th> 
                                                        <th scope="col">Color</th>
                                                        <th scope="col">Aktion</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($chanel_service as $chanel_service)
                                                    <tr>
                                                         
                                                        <td class="chanel_name">{{$chanel_service->service_name}}</td>
                                                        <td class="chanel_name">{{$chanel_service->chanel_name}}</td>
                                                        <td style="width: 180px;"> <div class="p-2" style="background-color: {{$chanel_service->txt_colr}};"></div></td>
                                                        <td>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <a  href="/employee/edit_service/{{$chanel_service->id}}" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                                                <a data-id="{{$chanel_service->id}}" data-bs-toggle="modal" data-bs-target="#deleteServiceRecordModal" class="link-danger delete_service_chanel fs-15"><i class="ri-delete-bin-line"></i></a>
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
<div class="modal fade zoomIn" id="deleteServiceRecordModal" tabindex="-1" aria-hidden="true">
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
                                            <h4>Sind Sie sicher?</h4>
                                            <p class="text-muted mx-4 mb-0">Sind Sie sicher, dass Sie diesen Datensatz entfernen möchten?</p>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Abbrechen</button>
                                        <button type="button" class="btn w-sm btn-danger " id="delete-service-record">Ja, löschen Sie es</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end modal -->
            
@endsection