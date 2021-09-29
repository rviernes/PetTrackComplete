@extends('layoutsVet.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> @section('content')
<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="/styles.css">
<div class="content-wrapper">
    <br>
    <!-- Default box -->
    <div class="card"> 
        @csrf
            <a class="btn btn-error btn-sm" href="/veterinary/customers" id="returnId">
                <i class="fas fa-arrow-left"></i> Return </a>
            <h3 id="pet_name_id">Pets</h3>
            <br> 
            @if(Session::has('success')) 
            <div class="alert alert-success" role="alert" id="messageModal">
                {{ Session::get('success') }}
            </div>
             @endif 
            @if(Session::has('warning')) 
            <div class="alert alert-warning" role="alert" id="messageModal">
                {{ Session::get('warning') }}
            </div>
             @endif
             @if(Session::has('error'))
            <div class="alert alert-danger" role="alert" id="messageModal">
                {{ Session::get('error') }}
            </div> @endif
            <!-- Main content -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th> Name</th>
                        <th> Gender</th>
                        <!-- <th style="width:95px;"scope="col"> Profile</th> -->
                        <th> Type </th>
                        <th> Breed </th>
                        <th>Clinic </th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr> @foreach ($PatientOwner as $owner)
                        <td>{{ $owner->pet_name }}</td>
                        <td>{{ $owner->pet_gender }}</td>
                        <td>{{ $owner->type_name }}</td>
                        <td>{{ $owner->breed_name }}</td>
                        <td>{{ $owner->clinic_name }}</td> 
                        
                        @if ($owner->pet_isActive == 1) 
                        <td>
                            <span class="badge badge-success">Active</span>
                        </td> 
                        @else 
                        <td>
                            <span class="badge badge-danger">Inactive</span>
                        </td> 
                        @endif 
                        
                        <td>
                            <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewModal{{ $owner->pet_id }}">
                                <i class="fas fa-folder"></i></a>
                            <a href="/veterinary/vieweditpatient/{{ $owner->pet_id }}" class="btn btn-info btn-sm">
                                <i class="fas fa-pencil-alt"></i></a>
                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $owner->pet_id }}">
                                <i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    {{-- View  modal  --}}
                    <div class="modal" id="viewModal{{ $owner->pet_id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title">Patient {{$owner->pet_name}} </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                    <h5>Pet name:        <br><strong> {{ $owner->pet_name }}            </strong></h5>
                                    </div>
                                    <div class="col-md-4">
                                    <h5>Gender:          <br><strong> {{ $owner->pet_gender }}          </strong></h5>
                                    </div>
                                    <div class="col-md-4">
                                    <h5>Birthdate: <br><strong> {{ $owner->pet_birthday }}  </strong></h5>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-md-4">
                                    <h5>Type:        <br><strong> {{ $owner->type_name }}            </strong></h5>
                                    </div>
                                    <div class="col-md-4">
                                    <h5>Breed:           <br><strong> {{ $owner->breed_name }}          </strong></h5>
                                    </div>
                                    <div class="col-md-4">
                                    <h5>Registered date: <br><strong> {{ $owner->pet_registeredDate }}  </strong></h5>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                    <h5>Owner:           <br><strong> {{ $owner->customer_name }} </strong></h5>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-4">
                                    <h5>Blood type:          <br><strong> {{ $owner->pet_bloodType }}          </strong></h5>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12" style="color: blue;">
                                    <h5>Pet prescription:         <strong> "{{ $owner->pet_notes }}"    </strong>
                                    </div>
                                </div>
                                <br>
                                    <h6>Address:         <strong> {{ $owner->customer_address }}    </strong></h5>
                                    
                                    @if ($owner->pet_isActive == "1") 
                                    <h5>Status : <strong> Active </strong></h5>
                                    @else 
                                    <h5>Status : <strong> Inactive </strong></h5> 
                                    @endif 
                                    <h5> 
                                        {!! QrCode::size(150)->eyeColor(0, 255, 255, 255, 0, 0, 0)->generate('name: '.$owner->pet_name. ' Gender: '.$owner->pet_gender. ' Type: '.$owner->type_name. ' Breed: '.$owner->breed_name. ' Registered Date: '. $owner->pet_registeredDate. ' Owner: '.$owner->clinic_name . ' Address: '.$owner->customer_address); !!} <br>
                                        <strong>Scan Me</strong>
                                    </h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end view modal --}}
                    </form>
                 </div>
            </div>
            {{-- delete warning modal --}}
            <div class="modal fade" id="deleteModal{{ $owner->pet_id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/veterinary/delete-custpatitent/{{ $owner->pet_id }}" method="GET">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <h3>Delete Patient?</h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger waves-effect remove-data-from-delete-form">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

     @endforeach </tbody>
    </table>
</div>
</div>
</div>
{{-- end edit modal  --}} undefined</section>undefined
<!-- /.content -->undefined</div>undefined
<!-- /.content-wrapper -->undefined</div>undefined
<!-- ./wrapper -->undefined
<!-- REQUIRED SCRIPTS -->undefined
<!-- jQuery -->undefined<script src="../../plugins/jquery/jquery.min.js"></script>undefined
<!-- Bootstrap 4 -->undefined<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>undefined
<!-- AdminLTE App -->undefined<script src="../../dist/js/adminlte.min.js"></script>undefined
<!-- AdminLTE for demo purposes -->undefined<script src="../../dist/js/demo.js"></script>undefined<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>undefined
<!-- Latest compiled and minified JavaScript -->undefined<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>undefined<script>
    $("document").ready(function() {
        setTimeout(function() {
            $("#messageModal").remove();
        }, 2000);
    });
</script> @endsection