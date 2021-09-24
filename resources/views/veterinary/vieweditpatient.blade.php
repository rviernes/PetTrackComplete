@extends('layoutsvet.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://jqueryvalidation.org/files/lib/jquery.js"></script>
<script src="https://jqueryvalidation.org/files/lib/jquery-1.11.1.js"></script>
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script>
    $().ready(function() {
        $("#editPet").validate({
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
            <h3 class="header">Edit Pet</h3>
            <br>
            <!-- Main content -->
            <form action="/veterinary/vieweditpatient-save/{{ $editPet->pet_id }}" enctype="multipart/form-data" method="post" class="cmxform" id="editPet"> @csrf <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="pet_name">Pet Name</label>
                                    <input type="name" class="form-control" value="{{ $editPet->pet_name }}" name="pet_name" placeholder="Enter Pet Name" id="pet_name">
                                    <span class="text-danger error-text customer_fname_error">@error('pet_name'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="pet_gender">Gender</label>
                                    <select id="pet_gender" class="form-control custom-select" name="pet_gender"> @if ($editPet->pet_gender == "Male") <option value="Male" selected>Male</option>
                                        <option value="Female">Female</option> @elseif ($editPet->pet_gender == "Female") <option value="Female" selected>Female</option>
                                        <option value="Male">Male</option> @endif
                                    </select>
                                    <span class="text-danger error-text customer_lname_error">@error('pet_gender'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="pet_type_id">Type</label>
                                    <select id="pet_type_id" class="form-control custom-select" name="pet_type_id"> @foreach ($getTypePet as $type) @if ($type->type_id == $editPet->pet_type_id ) <option value="{{ $type->type_id }}" selected>{{ $type->type_name }}</option> @else <option value="{{ $type->type_id }}">{{ $type->type_name }}</option> @endif @endforeach </select>
                                    <span class="text-danger error-text customer_lname_error">@error('pet_type_id'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="pet_breed_id">Breed</label>
                                    <select id="pet_breed_id" class="form-control custom-select" name="pet_breed_id"> @foreach ($getBreedPet as $breed) @if ($breed->breed_id == $editPet->pet_breed_id) <option value="{{ $breed->breed_id }}" selected>{{ $breed->breed_name }}</option> @else <option value="{{ $breed->breed_id }}">{{ $breed->breed_name }}</option> @endif @endforeach </select>
                                    <span class="text-danger error-text customer_blk_error">@error('pet_breed_id'){{ $message }}@enderror</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="pet_bloodType" class="form-label"> BloodType</label>
                                    <input type="text" class="form-control" value="{{ $editPet->pet_bloodType }}" name="pet_bloodType" placeholder="Optional" id="pet_bloodType">
                                    <span class="text-danger error-text customer_blk_error">@error('pet_bloodType'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="pet_registeredDate" required class="form-label"> Registered Date</label>
                                    <br>
                                    <input type="date" class="form-control" value="{{ $editPet->pet_registeredDate }}" id="date" name="pet_registeredDate" id="pet_registeredDate">
                                    <span class="text-danger error-text customer_blk_error">@error('pet_registeredDate'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="pet_birthday" required class="form-label"> Birthday</label>
                                    <br>
                                    <input type="date" class="form-control" value="{{ $editPet->pet_birthday }}" id="date" name="pet_birthday" id="pet_birthday">
                                    <span class="text-danger error-text customer_blk_error">@error('pet_birthday'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="customer_id">Owner</label> @foreach ($getOwnerPet as $petowner) @if ($petowner->customer_id == $editPet->customer_id) <input type="hidden" name="customer_id" id="customer_id" value="{{ $petowner->customer_id }}">
                                    <input type="text" disabled class="form-control" id="date" name="customer_name" value="{{ $petowner->customer_fname }} {{ $petowner->customer_lname}}">
                                    <span class="text-danger error-text customer_blk_error">@error('customer_name'){{ $message }}@enderror</span> @endif @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group" style="width: 300px;">
                                    <label for="pet_notes" class="form-label"> Notes</label>
                                    <textarea placeholder="Enter Description and Health Conditions" class="form-control" name="pet_notes" id="pet_notes">{{ $editPet->pet_notes }}</textarea>
                                    <span class="text-danger error-text customer_street_error">@error('pet_notes'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="inputClinic">Clinic</label>
                                    <select id="inputClinic" class="form-control custom-select" id="clinic_id" name="clinic_id"> @foreach ($getClinicPet as $clinic) @if ($clinic->clinic_id == $editPet->clinic_id) <option value="{{ $clinic->clinic_id }}" selected>{{ $clinic->clinic_name }}</option> @else <option value="{{ $clinic->clinic_id }}">{{ $clinic->clinic_name }}</option> @endif @endforeach </select>
                                    <span class="text-danger error-text customer_blk_error">@error('clinic_id'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px;">
                                    <label for="pet_isActive">Status</label>
                                    <select id="pet_isActive" class="form-control custom-select" id="pet_isActive" name="pet_isActive"> @if ($editPet->pet_isActive == "1") <option value="1" selected>Yes</option>
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
                                        <input type="file" id="customer_DP" name="image">
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