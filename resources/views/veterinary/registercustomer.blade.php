
@extends('layoutsvet.app')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://jqueryvalidation.org/files/lib/jquery.js"></script>
<script src="https://jqueryvalidation.org/files/lib/jquery-1.11.1.js"></script>
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>


<script>

    $().ready(function() {

        $("#addForm").validate({
            rules: {
                user_name: {
                    required: true,
                    maxlength: 20
                },
                user_password:{
                    required: true
                },
                user_mobile:{
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
                    required:  "Last name is required"
                },
                customer_mname: {
                    required:  "Middle name is required"
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
    label.error{
        color: #dc3545;
        font-size: 14px;
    }
</style>

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
        
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <a class="btn btn-error btn-sm" href="/veterinary/viewvetcustomer">
            <i class="fas fa-arrow-left">
            </i>
            Return
        </a>
      <h3 class="header">Register Customer</h3>
      <br>
     
      @if(Session::has('existing')) 
      <div class="alert alert-warning" role="alert" id="messageModal">
       {{ Session::get('existing') }}
     </div>
     @endif 
     
    <!-- Main content -->
    <form class="cmxform" action="{{ route('vet.addcustomer') }}" method="POST" id="addForm">
@csrf
    <table class="table table-striped table-hover">
  <thead>
    <tr>
    
        <input type="hidden" disabled style="width: 50px; border-color: white; background-color: white" class="form-control" name="userType_id" value="3">
        
        <td>
            <div class="form-group" style="">
                <label for="user_name">Username</label>
                <input type="text" style="width: 300px" class="form-control" id="user_name" name="user_name" placeholder="Enter username">

            </div>
        </td>
        <td>
            <div class="form-group">
                <label style="red" for="user_password">Password</label>
                <input type="password" style="width: 300px;" class="form-control" id="user_password" name="user_password" value="{{ old('user_password')}}" placeholder="Enter password">
            </div>
        </td>
        <td>
            <div class="form-group">
                <label for="user_mobile">Account Mobile</label>
                <input type="text" style="width: 300px" value="{{ old('user_mobile')}}" class="form-control" id="user_mobile" name="user_mobile" aria-describedby="emailHelp" placeholder="Enter mobile">
            
            </div>
        </td>
        <td>
            <div class="form-group">
                <label for="user_email">Email</label>
                <input type="email" class="form-control" value="{{ old('user_email')}}" style="width: 300px" id="user_email" name="user_email" placeholder="Enter email">
           
            </div>
        </td>
      
    </tr>
    <tr>
        <td >
            <div class="form-group">
                <label for="customer_fname">First Name</label>
                <input type="text" style="width: 300px" class="form-control" id="customer_fname" name="customer_fname"  placeholder="Enter First Name">
               
            </div>
        </td>

            <td >
                <div class="form-group">
                    <label for="customer_lname">Last Name</label>
                    <input type="text" style="width: 300px" class="form-control" id="customer_lname" name="customer_lname"  placeholder="Enter Last Name">
                 
                </div>
            </td>

            <td>
                <div class="form-group">
                    <label for="customer_mname">Middle Name</label>
                    <input type="text" style="width: 300px" class="form-control" id="customer_mname" name="customer_mname" aria-describedby="emailHelp" placeholder="Enter Middle Name">
                 
                </div>
            </td>
            <td>
                <div class="form-group">
                    <label for="customer_mobile">Mobile</label>
                    <input type="number" class="form-control" style="width: 300px" id="customer_mobile" name="customer_mobile" aria-describedby="emailHelp" placeholder="Enter Mobile No">
             
                </div>
            </td>
        
    </tr>
    <tr>
        <td>
            <div class="form-group">
                <label for="customer_tel">Telephone</label>
                <input type="number" class="form-control" style="width: 300px" id="customer_tel" name="customer_tel" placeholder="Enter Telephone">
            
            </div>
        </td>
        <td>
            <div class="form-group" style="width: 300px">
                <label for="customer_gender">Gender</label>
                <select id="customer_gender" class="form-control custom-select" id="customer_gender" name="customer_gender">
                  <option selected disabled>Choose Gender:</option>
                  <option value="Female">Female</option>
                  <option value="Male">Male</option>
                </select>
         
              </div>
        </td>
        <td>
            <div class="form-group" style="width: 300px">
                <label for="customer_birthday" class="form-label">Birthdate</label>
                <br>
                <div class="">
                  <input type="date" class="form-control" id="customer_birthday" name="customer_birthday">
                  
                </div>

                
              </div>
        </td>
        <td>
            <div class="form-group" style="width: 300px">
                <label for="customer_blk">House Block/Building/Floor No.</label>
                <input type="text" class="form-control" name="customer_blk" id="customer_blk"  placeholder="Enter Address">
         
            </div>
        </td>
    </tr>
    <tr>
        
        <td>
            <div class="form-group" style="width: 300px">
                <label for="customer_street">Street/Highway</label>
                <input type="text" class="form-control" name="customer_street" id="customer_street" placeholder="Enter Address">
         
            </div>
        </td>
        <td>
            <div class="form-group" style="width: 300px">
                <label for="customer_subdivision">Subdivision</label>
                <input type="text" class="form-control" name="customer_subdivision" id="customer_subdivision"  placeholder="Enter Address">
         
            </div>
        </td>
        <td>
            <div class="form-group" style="width: 300px">
                <label for="">Barangay</label>
                <input type="text" class="form-control" name="customer_barangay" id="customer_barangay" placeholder="Enter Address">
       
            </div>
        </td>
        <td>
            <div class="form-group" style="width: 300px">
                <label for="customer_city">City</label>
                <input type="text" class="form-control" name="customer_city" id="customer_city"  placeholder="Enter Address">

            </div>
        </td>
    </tr>

    <tr>
        <td>
            <div class="form-group" style="width: 300px">
                <label for="customer_zip">Zip Code</label>
                <input type="text" class="form-control" name="customer_zip" id="customer_zip" placeholder="Enter Addres">
    
            </div>
        </td>

        <td>
            <div class="form-group" style="width: 300px">
                <label for="isActive">Active</label>
                <select id="isActive" class="form-control custom-select" id="isActive" name="isActive">
                  <option selected disabled>is Customer active?</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>

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
    <button type="submit" class="btn btn-success btn-sm" style=" height: 40%;"> <i class="fas fa-user"></i> Register Customer </a></button>

   
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
<script src="../../dist/js/demo.js"></script>



@endsection