@extends('layoutsvet.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> @section('content') <div class="content-wrapper">
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
            <h3 class="header">Edit Pet</h3>
            <br>
            <!-- Main content -->
            <form action="/veterinary/viewveteditpatient-save/{{ $editPet->pet_id }}" method="post"> @csrf <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="exampleInputEmail1">Pet Name</label>
                                    <input type="name" class="form-control" value="{{ $editPet->pet_name }}" name="pet_name" placeholder="Enter Pet Name">
                                    <span class="text-danger error-text customer_fname_error">@error('pet_name'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="inputGender">Gender</label>
                                    <select id="inputStatus" class="form-control custom-select" name="pet_gender"> @if ($editPet->pet_gender == "Male") <option value="Male" selected>Male</option>
                                        <option value="Female">Female</option> @elseif ($editPet->pet_gender == "Female") <option value="Female" selected>Female</option>
                                        <option value="Male">Male</option> @endif
                                    </select>
                                    <span class="text-danger error-text customer_lname_error">@error('pet_gender'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="inputType">Type</label>
                                    <select id="inputType" class="form-control custom-select" name="pet_type_id"> @foreach ($getTypePet as $type) @if ($type->type_id == $editPet->pet_type_id ) <option value="{{ $type->type_id }}" selected>{{ $type->type_name }}</option> @else <option value="{{ $type->type_id }}">{{ $type->type_name }}</option> @endif @endforeach </select>
                                    <span class="text-danger error-text customer_lname_error">@error('pet_type_id'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="inputBreed">Breed</label>
                                    <select id="inputBreed" class="form-control custom-select" name="pet_breed_id"> @foreach ($getBreedPet as $breed) @if ($breed->breed_id == $editPet->pet_breed_id) <option value="{{ $breed->breed_id }}" selected>{{ $breed->breed_name }}</option> @else <option value="{{ $breed->breed_id }}">{{ $breed->breed_name }}</option> @endif @endforeach </select>
                                    <span class="text-danger error-text customer_blk_error">@error('pet_breed_id'){{ $message }}@enderror</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="inputBloodtype" class="form-label"> BloodType</label>
                                    <input type="bloodtype" class="form-control" value="{{ $editPet->pet_bloodType }}" name="pet_bloodType" placeholder="Optional">
                                    <span class="text-danger error-text customer_blk_error">@error('pet_bloodType'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="date" required class="form-label"> Registered Date</label>
                                    <br>
                                    <input type="date" class="form-control" value="{{ $editPet->pet_registeredDate }}" id="date" name="pet_registeredDate">
                                    <span class="text-danger error-text customer_blk_error">@error('pet_registeredDate'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="date" required class="form-label"> Birthday</label>
                                    <br>
                                    <input type="date" class="form-control" value="{{ $editPet->pet_birthday }}" id="date" name="pet_birthday">
                                    <span class="text-danger error-text customer_blk_error">@error('pet_birthday'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="inputCustomer">Owner</label> @foreach ($getOwnerPet as $petowner) @if ($petowner->customer_id == $editPet->customer_id) <input type="hidden" name="customer_id" id="customer_id" value="{{ $petowner->customer_id }}">
                                    <input type="text" disabled class="form-control" id="date" name="customer_name" value="{{ $petowner->customer_fname }} {{ $petowner->customer_lname}}">
                                    <span class="text-danger error-text customer_blk_error">@error('customer_name'){{ $message }}@enderror</span> @endif @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group" style="width: 300px;">
                                    <label for="inputnotes" class="form-label"> Notes</label>
                                    <textarea placeholder="Enter Description and Health Conditions" class="form-control" name="pet_notes">{{ $editPet->pet_notes }}</textarea>
                                    <span class="text-danger error-text customer_street_error">@error('pet_notes'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="inputClinic">Clinic</label>
                                    <select id="inputClinic" class="form-control custom-select" name="clinic_id"> @foreach ($getClinicPet as $clinic) @if ($clinic->clinic_id == $editPet->clinic_id) <option value="{{ $clinic->clinic_id }}" selected>{{ $clinic->clinic_name }}</option> @else <option value="{{ $clinic->clinic_id }}">{{ $clinic->clinic_name }}</option> @endif @endforeach </select>
                                    <span class="text-danger error-text customer_blk_error">@error('clinic_id'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px;>
																			<label for=" inputStatus">Status</label>
                                    <select id="inputStatus" class="form-control custom-select" name="pet_isActive"> @if ($editPet->pet_isActive == "1") <option value="1" selected>Yes</option>
                                        <option value="0">No</option> @else <option value="0" selected>No</option>
                                        <option value="1">Yes</option> @endif
                                    </select>
                                    <span class="text-danger error-text customer_blk_error">@error('pet_isActive'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="inputdp"> Profile Picture</label>
                                    <br>
                                    <form action="/action_page.php">
                                        <input type="file" id="customer_DP" name="filename" name="customer_DP">
                                </div>
                            </td>
                        </tr>
                    </thead>
                </table>
                <div style="text-align: right; height: 100; padding-top: 20px">
                    <button type="submit" class="btn btn-primary btn-sm" style=" height: 50%;">
                        <i class="fas fa-save"></i> Save Changes </a>
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