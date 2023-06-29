@extends('employee.template.admin_template')



@section('content')

            <div class="page-content">
                <div class="container-fluid">
                    

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0 flex-grow-1">Kundeninfo</h4>
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
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Telefonnummer</th>
                                                        <th scope="col">Volume</th>
                                                        <th scope="col">Provision</th>
                                                        <th scope="col">Service</th>
                                                        <th scope="col">Channel</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Aktion</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($customer_info as $customer_info)
                                                        <tr> 
                                                            <td>{{$customer_info->first_name}} {{$customer_info->last_name}}</td>
                                                            <td>{{$customer_info->email}}</td>
                                                            <td>{{$customer_info->phone_no}}</td>
                                                            <td>{{$customer_info->volume}}</td>
                                                            <td>{{$customer_info->provision}}</td>
                                                            <td>{{$customer_info->chanel_name}}</td>
                                                            <td>{{$customer_info->service_name}}</td>
                                                            <td>{{$customer_info->status}}</td>
                                                            <td>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <a  href="/employee/edit_customer/{{$customer_info->id}}" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                                                <a data-id="{{$customer_info->id}}" data-bs-toggle="modal" data-bs-target="#deletecustomerRecordModal" class="link-danger delete_customer fs-15"><i class="ri-delete-bin-line"></i></a>
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
                     

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

 
            <!-- Modal -->
            <div class="modal fade zoomIn" id="deletecustomerRecordModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                </div>
                                <form method='post' id="chanel-customer-form" action='' enctype="multipart/form-data"> 
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="modal-body">
                                        <div class="mb-3" id="modal-id" style="display: none;">
                                            <label for="customer-id-field" class="form-label">ID</label>
                                            <input type="text" id="del-customer-field" name="id" class="form-control" placeholder="ID" readonly />
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
                                        <button type="button" class="btn w-sm btn-danger " id="delete-customer-record">Ja, löschen Sie es</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end modal -->
@endsection