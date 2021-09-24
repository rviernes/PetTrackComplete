@extends('layoutsvet.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://jqueryvalidation.org/files/lib/jquery.js"></script>
<script src="https://jqueryvalidation.org/files/lib/jquery-1.11.1.js"></script>
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script>
    $().ready(function() {
        $("#addPet").validate({
            rules: {
                pet_name: {
                    required: true
                },
                pet_gender: {
                    required: true
                },
                pet_type_id: {
                    required: true
                },
                pet_breed_id: {
                    required: true
                },
                pet_bloodType: {
                    required: true
                },
                pet_registeredDate: {
                    required: true,
                    date: true
                },
                pet_birthday: {
                    required: true,
                    date: true
                },
                customer_name: {
                    required: true
                },
                pet_notes: {
                    required: true
                },
                clinic_id: {
                    required: true
                },
                pet_isActive: {
                    required: true
                }
            },
            messages: {
                pet_name: {
                    required: "Pet name is required"
                },
                pet_gender: {
                    required: "Gender is required"
                },
                pet_type_id: {
                    required: "Pet type is required"
                },
                pet_breed_id: {
                    required: "Breed is required"
                },
                pet_bloodType: {
                    required: "Bloodtype is required"
                },
                pet_registeredDate: {
                    required: "Register date is required",
                    date: "Please enter a date"
                },
                pet_birthday: {
                    required: "Birthday is required",
                    date: "Please enter a date"
                },
                customer_name: {
                    required: "Phone number is required"
                },
                pet_notes: {
                    required: "Notes is required"
                },
                clinic_id: {
                    required: "Clinic is required"
                },
                pet_isActive: {
                    required: "Status is required"
                }
            }
        });
    });
</script>
<style>
    label.error {
        color: #dc3545;
        font-size: 14px;
    }
</style> @section('content') <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"></ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <a class="btn btn-error btn-sm" href="/veterinary/viewvetcustomer">
                <i class="fas fa-arrow-left"></i> Return </a>
            <h3 class="header">Register Pet</h3>
            <br> @if(Session::has('fail')) <div class="alert alert-danger" role="alert" id="messageModal">
                {{ Session::get('fail') }}
            </div> @endif
            <!-- Main content -->
            <form class="cmxform" action="{{ route('vet.addpatient') }}" enctype="multipart/form-data" method="post" id="addPet"> @csrf <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="pet_name">Pet Name</label>
                                    <input type="name" class="form-control" name="pet_name" id="pet_name" placeholder="Enter Pet Name">
                                    <span class="text-danger error-text customer_fname_error">@error('pet_name'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="pet_gender">Gender</label>
                                    <select id="pet_gender" class="form-control custom-select" name="pet_gender">
                                        <option selected disabled>Choose...</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                    <span class="text-danger error-text customer_lname_error">@error('pet_gender'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="pet_type_id">Type</label>
                                    <select id="pet_type_id" class="form-control custom-select" name="pet_type_id">
                                        <option selected disabled>Choose pet Type</option> @foreach ($pet_types as $pet_type) <option value="{{ $pet_type->type_id }}">{{ $pet_type->type_name }}</option> @endforeach
                                    </select>
                                    <span class="text-danger error-text customer_lname_error">@error('pet_type_id'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="pet_breed_id">Breed</label>
                                    <select id="pet_breed_id" class="form-control custom-select" name="pet_breed_id">
                                        <option selected disabled>Choose Breed</option> @foreach ($pet_breeds as $pet_breed) <option value="{{ $pet_breed->breed_id }}">{{ $pet_breed->breed_name }}</option> @endforeach
                                    </select>
                                    <span class="text-danger error-text customer_blk_error">@error('pet_breed_id'){{ $message }}@enderror</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="pet_bloodType" class="form-label"> BloodType</label>
                                    <input type="bloodtype" class="form-control" name="pet_bloodType" id="pet_bloodType" placeholder="Optional">
                                    <span class="text-danger error-text customer_blk_error">@error('pet_bloodType'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="pet_registeredDate" required class="form-label"> Registered Date</label>
                                    <br>
                                    <input type="date" class="form-control" id="pet_registeredDate" name="pet_registeredDate">
                                    <span class="text-danger error-text customer_blk_error">@error('pet_registeredDate'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="pet_birthday" required class="form-label"> Birthday</label>
                                    <br>
                                    <input type="date" class="form-control" id="pet_birthday" name="pet_birthday">
                                    <span class="text-danger error-text customer_blk_error">@error('pet_birthday'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="customer_id">Owner</label>
                                    <input type="hidden" name="customer_id" id="customer_id" value="{{ $custInfo->customer_id}}">
                                    <input type="text" disabled class="form-control" id="date" name="customer_name" value="{{ $custInfo->customer_fname}} {{ $custInfo->customer_lname}}">
                                    <span class="text-danger error-text customer_id_error"></span>
                                    <span class="text-danger error-text customer_blk_error">@error('customer_name'){{ $message }}@enderror</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group" style="width: 300px;">
                                    <label for="pet_notes" class="form-label"> Notes</label>
                                    <textarea placeholder="Enter Description and Health Conditions" class="form-control" name="pet_notes" id="pet_notes"></textarea>
                                    <span class="text-danger error-text customer_street_error">@error('pet_notes'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="clinic_id">Clinic: </label>
                                    <select id="clinic_id" class="form-control custom-select" name="clinic_id"> @foreach ($pet_clinics as $clinic) <option value="{{ $clinic->clinic_id }}">{{ $clinic->clinic_name }}</option> @endforeach </select>
                                    <span class="text-danger error-text customer_blk_error">@error('clinic_id'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px;">
                                    <label for="pet_isActive">Status</label>
                                    <select id="pet_isActive" class="form-control custom-select" name="pet_isActive">
                                        <option selected disabled>is Pet Active?</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    <span class="text-danger error-text customer_blk_error">@error('pet_isActive'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="inputdp"> Profile Picture</label>
                                    <br>
                                    <form action="/action_page.php">
                                        <input type="file" id="image" name="image">
                                </div>
                            </td>
                        </tr>
                    </thead>
                </table>
                <div style="text-align: right; height: 100; padding-top: 20px">
                    <button type="submit" class="btn btn-success btn-sm" style=" height: 40%;">
                        <i class="fas fa-user"></i> Register Pet </a>
                    </button>
                </div>
            </form>
        </div>
        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="../../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../dist/js/demo.js"></script> @endsection