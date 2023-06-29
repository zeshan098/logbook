@extends('backoffice.template.admin_template')



@section('content')

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Assign User</h4>
                                     
                                </div><!-- end card header -->
                                <div class="card-body">
                                     
                                    <div class="live-preview">
                                        <form method='post' action="{{ url('backoffice/update_assign_user', $edit_assign_user->id) }}" class="needs-validation" novalidate action=" ">
                                        <input name="_token" id="token" type="hidden" value="{{ csrf_token() }}"/>
                                            <div class="row g-3">
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" name="supervisor_id" id="supervisor_id" aria-label="Floating label select example" require> 
                                                        <option selected>Select Supervisor</option>
                                                        @foreach($supervisor as $supervisor)
                                                            <option value="{{$supervisor->id}}" {{$edit_assign_user->supervisor_id == $supervisor->id  ? 'selected' : ''}}>{{$supervisor->name}}</option> 
                                                        @endforeach  
                                                        </select>
                                                        <label for="floatingSelect">Supervisor</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" name="student_id" id="student_id" aria-label="Floating label select example" require> 
                                                        <option selected>Select Student</option>
                                                        @foreach($student as $student)
                                                            <option value="{{$student->id}}" {{$edit_assign_user->student_id == $student->id  ? 'selected' : ''}}>{{$student->name}}</option> 
                                                        @endforeach  
                                                        </select>
                                                        <label for="floatingSelect">Student</label>
                                                    </div>
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