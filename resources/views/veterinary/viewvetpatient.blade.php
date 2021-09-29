@extends('layoutsVet.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> 
@section('content')
@include('sweet::alert')
<link rel="stylesheet" href="/styles.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- /.content-header -->
    <!-- <form action="{{ route('veterinary.patientsearch') }}" method="get">
        <div class="input-group" style="width: 400px; margin-left: 500px">
            <input type="search" class="form-control rounded" placeholder="Search...." aria-label="Search" name="petsearch" id="petsearch" style="width: 200px;" />
            <button type="submit" class="btn btn-outline-primary">search</button>
            <br>
        </div>
    </form> -->
    <br>
    <!-- Default box --> 
    @if(Session::has('patients_deleted')) 
    <div class="alert alert-danger" role="alert">
        {{ Session::get('patients_deleted') }}
    </div> 
    @endif 
    
        @if(Session::has('success')) 
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div> 
        @endif 
        
    @if(Session::has('warning')) 
    <div class="alert alert-success" role="alert">
        {{ Session::get('warning') }}
    </div> 
    @endif 

        <div class="card"> 
            @csrf 
                <h3 class="card-title" id="pet_name_id">List of all patients</h3>
            <div class="card-body p-0">
                <table style="table-layout: fixed; width: 100%;" class="table table-striped projects">
                    <thead>
                        <tr>
                            <th> Name</th>
                            <th> Gender</th>
                            <!-- <th style="width:95px;"scope="col"> Profile</th> -->
                            <th> Type </th>
                            <th> Breed </th>
                            <th>Customer </th>
                            <th>Clinic </th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody> @foreach ($petInfoDatas as $info) <tr>
                            <td>{{ $info->pet_name }}</td>
                            <td>{{ $info->pet_gender }}</td>
                            <td>{{ $info->type_name }}</td>
                            <td>{{ $info->breed_name }}</td>
                            <td>{{ $info->customer_name}}</td>
                            <td>{{ $info->clinic_name}}</td> 

                            @if ($info->pet_isActive==1) <td>
                                <span class="badge badge-success">Active</span>
                            </td> 
                            @else 
                            
                            <td>
                                <span class="badge badge-danger">Inactive</span>
                            </td> @endif <td class="project-actions">
                                <a href="" class="btn btn-primary " data-id="" data-toggle="modal" data-target="#viewModal{{ $info->pet_id }}">
                                    <i class="fas fa-folder"></i> View</a>
                            </td>
                        </tr>
                        <!-- /.card -->
                        <!-- {{-- View  modal  --}} -->
                        <div class="modal" id="viewModal{{ $info->pet_id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title">View Patients</h1>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <h5>Pet name:        <br><strong> {{ $info->pet_name }}            </strong></h5>
                                                </div>
                                                <div class="col-md-4">
                                                <h5>Gender:        <br><strong> {{ $info->pet_gender }}            </strong></h5>
                                                </div>
                                                <div class="col-md-4">
                                                <h5>Birthdate:           <br><strong> {{ $info->pet_birthday }}          </strong></h5>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <h5>Type:        <br><strong> {{ $info->type_name }}            </strong></h5>
                                                </div>
                                                <div class="col-md-4">
                                                <h5>Breed:        <br><strong> {{ $info->breed_name }}            </strong></h5>
                                                </div>
                                                <div class="col-md-4">
                                                <h5>Registered Date:           <br><strong> {{ $info->pet_registeredDate }}          </strong></h5>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <h5>Owner:        <br><strong> {{ $info->customer_name}}            </strong></h5>
                                                </div>
                                                <div class="col-md-4">
                                                <h5></h5>
                                                </div>
                                                <div class="col-md-4">
                                                <h5>Bloodtype:           <br><strong> {{ $info->pet_bloodType }}          </strong></h5>
                                            </div>
                                        </div>
                                        
                                        <h5 style="color: blue;">Pet prescription: <strong>"{{ $info->pet_notes }}"</strong><br><br>

                                        
                                        <h6>Address:         <strong> {{ $info->customer_address }}    </strong></h5>
                                        
                                        @if ($info->pet_isActive == "1") 
                                            <h5>Status : <strong> Active </strong></h5>
                                            @else 
                                            <h5>Status : <strong> Inactive </strong></h5> 
                                            @endif 
                                            <h5> 
                                        </h5>


                                        {{-- {{ QrCode::generate('http://127.0.0.1:8000/veterinary/qrcode/$info->pet_id'); }} --}} <h5 style="text-align: center"> 
                                            {!! QrCode::size(150)->generate('name: '.$info->pet_name. ' Gender: '.$info->pet_gender. ' Type: '.$info->type_name. ' Breed: '.$info->breed_name. ' Registered Date: '.$info->pet_registeredDate. ' Owner: '.$info->customer_name. ' Address: '.$info->customer_address); !!} <br>
                                            <strong>Scan Me</strong>
                                        </h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- delete warning modal --}}
                        <div class="modal fade" id="deleteModal{{ $info->pet_id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="/veterinary/delete-viewvetpatient/{{ $info->pet_id }}" method="GET">
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
                        </div> @endforeach
                    </tbody>
                </table>
                {{-- </section> --}}
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- jQuery -->
        <script src="{{asset('vendors/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('vendors/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script type="text/javascript">
            var route = "{{ url('patientautocomplete-search') }}";
            $('#petsearch').typeahead({
                source: function(query, process) {
                    return $.
                },
            })
        </script> @endsection