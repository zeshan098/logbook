@extends('employee.template.admin_template')



@section('content')

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Service Hinzufügen</h4>
                                     
                                </div><!-- end card header -->
                                <div class="card-body">
                                     
                                    <div class="live-preview">
                                        <form method='post' id="chanelcreate" class="needs-validation" novalidate action=" ">
                                        <input name="_token" id="token" type="hidden" value="{{ csrf_token() }}"/>
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="chanel_name" name="chanel_name" placeholder="Enter your Channel Name" required>
                                                        <label for="chanel_name">Servicename</label>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Bitte geben Sie einen Servicenamen ein
                                                    </div>
                                                </div>
                                                 
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" id="chanel_create" class="btn btn-primary">Absenden</button>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Servicelisten</h4>
                                     
                                </div><!-- end card header -->

                                <div class="card-body">
                                    
                                    <div class="live-preview">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                         
                                                        <th scope="col">Servicename</th> 
                                                        <th scope="col">Aktion</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($chanel as $chanel)
                                                    <tr>
                                                         
                                                        <td class="chanel_name">{{$chanel->chanel_name}}</td>
                                                        <td>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <a  data-id="{{ $chanel->id }}" data-name="{{ $chanel->chanel_name }}" data-bs-toggle="modal" data-bs-target="#showModal" class="channel_page link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                                                <a data-id="{{$chanel->id}}" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" class="link-danger delete_chanel fs-15"><i class="ri-delete-bin-line"></i></a>
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


            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form method='post' id="chanel-form" action='' enctype="multipart/form-data"> 
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="modal-body">

                                        <div class="mb-3" id="modal-id" style="display: none;">
                                            <label for="id-field" class="form-label">ID</label>
                                            <input type="text" id="id-field" name="id" class="form-control" placeholder="ID" readonly />
                                        </div>

                                        <div class="mb-3">
                                            <label for="customername-field" class="form-label">Servicename</label>
                                            <input type="text" id="chanel-field" name="chanel_name" class="form-control" placeholder="Enter Name" required />
                                        </div>

                                         

                                         
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Abbrechen</button> 
                                            <button type="button" id="update_chanel" class="btn btn-success" id="edit-btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                </div>
                                <form method='post' id="chanel-form" action='' enctype="multipart/form-data"> 
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="modal-body">
                                        <div class="mb-3" id="modal-id" style="display: none;">
                                            <label for="id-field" class="form-label">ID</label>
                                            <input type="text" id="del-id-field" name="id" class="form-control" placeholder="ID" readonly />
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
                                        <button type="button" class="btn w-sm btn-danger " id="delete-record">Ja, löschen Sie es</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end modal -->
@endsection