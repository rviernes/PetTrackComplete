@extends('layoutsvet.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> @section('content') <div class="content-wrapper">
<script src="https://jqueryvalidation.org/files/lib/jquery.js"></script>
<script src="https://jqueryvalidation.org/files/lib/jquery-1.11.1.js"></script>
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script> 

<script>
    $().ready(function() {
        $("#confirmed_Password").validate({
            rules: {
                
                oldpassword: {
                    required: true
                },
                new_pass: {
                    required: true
                },
                check_pass:{
                    required: true,
                    equalTo: "#new_pass"
                }
            },
            messages: {

                oldpassword: {
                    required: "Password is required"
                },
                new_pass: {
                    required: "New password is required"
                },
                check_pass: {
                    required: "Confirmed new password is required",

                    equalTo: "Please enter the same password as above"
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
</style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Profile</h1>
                </div>
        
            <!-- Profile Image -->
          
            
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- update -->
                     @if($message = Session::get('userUpdate')) 
                     <div class="text-success alert-block text-center" id="update-success">
                        <strong>{{ $message }}</strong>
                    </div> @endif
                    
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline ">
                        <div class="card-body  box-profile card text-center">
                            <div class="card text-center">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset('vendors/dist/img/han.jpg') }}" alt="Profile Picture">
                                </div>
                                <h3 class="profile-username text-center"> {{ $LoggedUserInfo->vet_fname }},{{ $LoggedUserInfo->vet_lname }}</h3>
                <a href="custeditProfile" id="change_dp" class="btn btn-primary btn-block"><b>Edit Profile </b></a>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                             @if(Session::has('warning')) 
                             <div class="alert alert-warning" role="alert" id="messageModal">
                                {{ Session::get('warning') }}
                            </div> 
                            @endif
                             @if(Session::has('error')) 
                             <div class="alert alert-danger" role="alert" id="messageModal">
                                {{ Session::get('error') }}
                            </div> 
                            @endif
                             <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#personal_info" data-toggle="tab">Personal Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#change_password" data-toggle="tab">Change Password </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class=" active tab-pane" id="personal_info">
                                    <form class="form-horizontal" action="/veterinary/editprofile/{{ $LoggedUserInfo->vet_id }}/{{ $LoggedUserInfo->user_id }}" method="POST" action="#" id="InfoForm"> @csrf <table class="table">
                                          @csrf  
                                        <thead>
                                                <tr>
                                                    <td style="border: none">
                                                        <div class="form-group row" style="width: 250px">
                                                            <label for="inputName">Username:</label>
                                                            <input type="text" class="form-control" id="user_name" value="{{ $LoggedUserInfo->user_name }}" name="user_name">
                                                            <span class="text-danger error-text name_error"></span>
                                                        </div>
                                                    </td>
                                                    <td style="border: none">
                                                        <div class="form-group row" style="width: 250px">
                                                            <label for="inputName2">Account Mobile No:</label>
                                                            <input type="number" class="form-control" id="user_mobile" value="{{ $LoggedUserInfo->user_mobile }}" name="user_mobile">
                                                            <span class="text-danger error-text mobile_error"></span>
                                                        </div>
                                                    </td style="border: none">
                                                    <td style="border: none">
                                                        <div class="form-group row" style="width: 250px">
                                                            <label for="inputEmail">Email:</label>
                                                            <input type="email" class="form-control" id="user_email" value="{{ $LoggedUserInfo->user_email }}" placeholder="Enter Email" name="user_email">
                                                            <span class="text-danger error-text email_error"></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none">
                                                        <div class="form-group row" style="width: 250px">
                                                            <label for="inputEmail">First Name:</label>
                                                            <input type="text" class="form-control" id="vet_fname" value="{{ $LoggedUserInfo->vet_fname }}" placeholder="Enter First Name" name="vet_fname">
                                                            <span class="text-danger error-text email_error"></span>
                                                        </div>
                                                    </td>
                                                    <td style="border: none">
                                                        <div class="form-group row" style="width: 250px">
                                                            <label for="inputEmail">Last Name:</label>
                                                            <input type="text" class="form-control" id="vet_lname" value="{{ $LoggedUserInfo->vet_lname }}" placeholder="Enter Last Name" name="vet_lname">
                                                            <span class="text-danger error-text email_error"></span>
                                                        </div>
                                                    </td>
                                                    <td style="border: none">
                                                        <div class="form-group row" style="width: 250px">
                                                            <label for="inputEmail">Middle Name:</label>
                                                            <input type="text" class="form-control" id="vet_mname" value="{{ $LoggedUserInfo->vet_mname }}" placeholder="Enter Mobile Name" name="vet_mname">
                                                            <span class="text-danger error-text email_error"></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none">
                                                        <div class="form-group row" style="width: 250px">
                                                            <label for="inputEmail">Contact Mobile No:</label>
                                                            <input type="text" class="form-control" id="vet_mobile" value="{{ $LoggedUserInfo->vet_mobile }}" placeholder="Enter Email" name="vet_mobile">
                                                            <span class="text-danger error-text email_error"></span>
                                                        </div>
                                                    </td>
                                                    <td style="border: none">
                                                        <div class="form-group row" style="width: 250px">
                                                            <label for="inputEmail">Telephone No:</label>
                                                            <input type="text" class="form-control" id="vet_tel" value="{{ $LoggedUserInfo->vet_tel }}" placeholder="Enter Email" name="vet_tel">
                                                            <span class="text-danger error-text email_error"></span>
                                                        </div>
                                                    </td>
                                                    <td style="border: none">
                                                        <div class="form-group row" style="width: 250px">
                                                            <label for="inputEmail">Blk No:</label>
                                                            <input type="text" class="form-control" id="vet_blk" value="{{ $LoggedUserInfo->vet_blk }}" placeholder="Enter Email" name="vet_blk">
                                                            <span class="text-danger error-text email_error"></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none">
                                                        <div class="form-group row" style="width: 250px">
                                                            <label for="inputEmail">Street:</label>
                                                            <input type="text" class="form-control" id="vet_street" value="{{ $LoggedUserInfo->vet_street}}" placeholder="Enter Email" name="vet_street">
                                                            <span class="text-danger error-text email_error"></span>
                                                        </div>
                                                    </td>
                                                    <td style="border: none">
                                                        <div class="form-group row" style="width: 250px">
                                                            <label for="inputEmail">Subdivision:</label>
                                                            <input type="text" class="form-control" id="vet_subdivision" value="{{ $LoggedUserInfo->vet_subdivision }}" placeholder="Enter Email" name="vet_subdivision">
                                                            <span class="text-danger error-text email_error"></span>
                                                        </div>
                                                    </td>
                                                    <td style="border: none">
                                                        <div class="form-group row" style="width: 250px">
                                                            <label for="inputEmail">Barangay:</label>
                                                            <input type="text" class="form-control" id="vet_barangay" value="{{ $LoggedUserInfo->vet_barangay }}" placeholder="Enter Email" name="vet_barangay">
                                                            <span class="text-danger error-text email_error"></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none">
                                                        <div class="form-group row" style="width: 250px">
                                                            <label for="inputEmail">City:</label>
                                                            <input type="text" class="form-control" id="vet_city" value="{{ $LoggedUserInfo->vet_city }}" placeholder="Enter Email" name="vet_city">
                                                            <span class="text-danger error-text email_error"></span>
                                                        </div>
                                                    </td>
                                                    <td style="border: none">
                                                        <div class="form-group row" style="width: 250px">
                                                            <label for="inputEmail">Zip Code:</label>
                                                            <input type="text" class="form-control" id="vet_zip" value="{{ $LoggedUserInfo->vet_zip }}" placeholder="Enter Email" name="vet_zip">
                                                            <span class="text-danger error-text email_error"></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>
                                        <div class="form-group row" style="width: 250px; margin-left: 850px;  text-align: right">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane fade" id="change_password">
                                    <form class="form-horizontal" id="confirmed_Password" action="/veterinary/changepass/{{ $LoggedUserInfo->user_id }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="oldpassword" class="col-sm-2 col-form-label">Old Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="new_pass" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="New Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="check_pass" class="col-sm-2 col-form-label">Confirm Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="check_pass" name="check_pass" placeholder="Confirm New Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Update Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div> @endsection
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script src="{{asset('vendors/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
    $("document").ready(function() {
        setTimeout(function() {
            $("#messageModal").remove();
        }, 2000);
    });
</script>
</body>
</html>