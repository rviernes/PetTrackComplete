@extends('layoutsvet.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://jqueryvalidation.org/files/lib/jquery.js"></script>
<script src="https://jqueryvalidation.org/files/lib/jquery-1.11.1.js"></script>
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script>
    $().ready(function() {
        $("#editForm").validate({
            rules: {
                user_name: {
                    required: true,
                    maxlength: 20
                },
                user_password: {
                    required: true
                },
                user_mobile: {
                    required: true,
                    number: true,
                    minlength: 11,
                    maxlength: 11
                },
                user_email: {
                    required: true,
                    email: true
                },
                customer_fname: {
                    required: true
                },
                customer_lname: {
                    required: true
                },
                customer_mname: {
                    required: true
                },
                customer_mobile: {
                    required: true,
                    number: true,
                    minlength: 11,
                    maxlength: 11
                },
                customer_tel: {
                    required: true
                },
                customer_birthday: {
                    required: true
                },
                customer_gender: {
                    required: true
                },
                customer_blk: {
                    required: true
                },
                customer_street: {
                    required: true
                },
                customer_subdivision: {
                    required: true
                },
                customer_barangay: {
                    required: true
                },
                customer_city: {
                    required: true
                },
                customer_zip: {
                    required: true,
                    number: true
                },
                isActive: {
                    required: true
                }
            },
            messages: {
                user_name: {
                    required: "First name is required"
                },
                user_password: {
                    required: "Password is required"
                },
                user_mobile: {
                    required: "Phone number is required",
                    minlength: "Phone number must be of 11 digits"
                },
                user_email: {
                    required: "Email is required",
                    email: "Email must be a valid email address"
                },
                customer_fname: {
                    required: "first name is required"
                },
                customer_lname: {
                    required: "Last name is required"
                },
                customer_mname: {
                    required: "Middle name is required"
                },
                customer_mobile: {
                    required: "Phone number is required",
                    minlength: "Phone number must be of 11 digits"
                },
                customer_tel: {
                    required: "Address is required",
                    maxlength: "Telephone number must be of 11 digits"
                },
                customer_gender: {
                    required: "Gender is required"
                },
                customer_birthday: {
                    required: "Birthday is required"
                },
                customer_blk: {
                    required: "Blk is required"
                },
                customer_street: {
                    required: "Street is required"
                },
                customer_subdivision: {
                    required: "Subdivision is required"
                },
                customer_barangay: {
                    required: "Barangay is required"
                },
                customer_city: {
                    required: "City is required"
                },
                customer_zip: {
                    required: "Zip Code is required"
                },
                isActive: {
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
            <h3 class="header">Update Customer</h3>
            <br>
            <!-- Main content -->
            <form class="cmxform" action="/veterinary/save_customer/{{ $vetcust_id->customer_id }}" method="post" id="editForm"> @csrf <table class="table table-striped table-hover">
                    <thead> @if ($vetcust_id) <input type="hidden" value="{{ $vetcust_id->customer_id }}">
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="customer_fname">First Name</label>
                                    <input type="text" style="width: 300px" class="form-control" value="{{ $vetcust_id->customer_fname }}" id="customer_fname" name="customer_fname" placeholder="Enter First Name">
                                    <span class="text-danger error-text customer_fname_error">@error('customer_fname'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="customer_lname">Last Name</label>
                                    <input type="text" style="width: 300px" value="{{ $vetcust_id->customer_lname }}" class="form-control" id="customer_lname" name="customer_lname" placeholder="Enter Last Name">
                                    <span class="text-danger error-text customer_lname_error">@error('customer_lname'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="customer_mname">Middle Name</label>
                                    <input type="text" style="width: 300px" value="{{ $vetcust_id->customer_mname }}" class="form-control" id="customer_mname" name="customer_mname" aria-describedby="emailHelp" placeholder="Enter Middle Name">
                                    <span class="text-danger error-text customer_mname_error">@error('customer_mname'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="customer_mobile">Mobile</label>
                                    <input type="number" class="form-control" value="{{ $vetcust_id->customer_mobile }}" style="width: 300px" id="customer_mobile" name="customer_mobile" aria-describedby="emailHelp" placeholder="Enter Mobile No">
                                    <span class="text-danger error-text customer_mobile_error">@error('customer_mobile'){{ $message }}@enderror</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="customer_tel">Telephone</label>
                                    <input type="number" class="form-control" value="{{ $vetcust_id->customer_tel }}" style="width: 300px" id="customer_tel" name="customer_tel" placeholder="Enter Telephone">
                                    <span class="text-danger error-text customer_tel_error">@error('customer_tel'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="customer_gender">Gender</label>
                                    <select id="customer_gender" class="form-control custom-select" name="customer_gender"> @if ($vetcust_id->customer_gender=="Male") <option value="Male" selected>Male</option>
                                        <option value="Female">Female</option> @elseif ($vetcust_id->customer_gender=="Female") <option value="Female" selected>Female</option>
                                        <option value="Male">Male</option> @endif
                                    </select>
                                    <span class="text-danger error-text customer_gender_error">@error('customer_gender'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="customer_birthday" required class="form-label">Birthdate</label>
                                    <br>
                                    <div class="">
                                        <input type="date" class="form-control" value="{{ $vetcust_id->customer_birthday }}" id="customer_birthday" name="customer_birthday">
                                        <span class="text-danger error-text customer_birthday_error">@error('customer_birthday'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="customer_blk">House Block/Building/Floor No.</label>
                                    <input type="text" class="form-control" value="{{ $vetcust_id->customer_blk }}" name="customer_blk" id="customer_blk" placeholder="Enter Address">
                                    <span class="text-danger error-text customer_blk_error">@error('customer_blk'){{ $message }}@enderror</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="customer_street">Street/Highway</label>
                                    <input type="text" class="form-control" value="{{ $vetcust_id->customer_street }}" name="customer_street" id="customer_street" placeholder="Enter Address">
                                    <span class="text-danger error-text customer_street_error">@error('customer_street'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="customer_subdivision">Subdivision</label>
                                    <input type="text" class="form-control" value="{{ $vetcust_id->customer_subdivision }}" name="customer_subdivision" id="customer_subdivision" placeholder="Enter Address">
                                    <span class="text-danger error-text customer_subdivision_error">@error('customer_subdivision'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="customer_barangay">Barangay</label>
                                    <input type="text" class="form-control" value="{{ $vetcust_id->customer_barangay }}" name="customer_barangay" id="customer_barangay" placeholder="Enter Address">
                                    <span class="text-danger error-text customer_barangay_error">@error('customer_barangay'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="customer_city">City</label>
                                    <input type="text" class="form-control" value="{{ $vetcust_id->customer_city }}" name="customer_city" id="customer_city" placeholder="Enter Address">
                                    <span class="text-danger error-text customer_city_error">@error('customer_city'){{ $message }}@enderror</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="customer_zip">Zip Code</label>
                                    <input type="text" class="form-control" value="{{ $vetcust_id->customer_zip }}" name="customer_zip" id="customer_zip" placeholder="Enter Addres">
                                    <span class="text-danger error-text customer_zip_error">@error('customer_zip'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="inputStatus">User</label>
                                    <select id="isActive" class="form-control custom-select" name="id">
                                        <option value="{{ $vetcust_id->user_id }}">{{ $vetcust_id->user_id }}</option>
                                    </select>
                                </div>
                                <span class="text-danger error-text user_id_error">@error('user_id'){{ $message }}@enderror</span>
                            </td>
                            <td>
                                <div class="form-group" style="width: 300px">
                                    <label for="isActive">Active</label>
                                    <select id="isActive" class="form-control custom-select" name="isActive"> @if ($vetcust_id->customer_isActive == 1) <option value="1" selected>Yes</option>
                                        <option value="0">No</option> @elseif ($vetcust_id->customer_isActive == 0) <option value="0" selected>No</option>
                                        <option value="1">Yes</option> @else @endif
                                    </select>
                                    <span class="text-danger error-text isActive_error">@error('isActive'){{ $message }}@enderror</span>
                                </div>
                            </td>
                            {{-- <td>
																								<div class="form-group" style="width: 300px">
																									<label for="inputdp"> Profile Picture</label>
																									<br>
																										<form action="/action_page.php">
																											<input type="file" id="customer_DP" name="filename" name="customer_DP">
																											</div>
																										</td> --}}
                        </tr> @endif
                    </thead>
                </table>
                <div style="text-align: right; height: 100; padding-top: 20px">
                    <button type="submit" class="btn btn-primary btn-sm" style=" height: 50%;">
                        <i class="fas fa-user"></i> Save Changes </a>
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