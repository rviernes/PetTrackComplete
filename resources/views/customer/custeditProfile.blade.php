@extends('layoutsCustomer.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> @section('content') <div class="card">
  
  
  
   <!-- update -->
   @if($message = Session::get('userUpdate'))
   <div class="text-success alert-block text-center" id="update-success">
       <strong>{{ $message }}</strong>
   </div>
@endif

<div class="card-header">
        <a class="btn btn-error btn-sm" href="/customer/custProfile">
            <i class="fas fa-arrow-left"></i> Return </a>
        <h3 class="header">Edit User Profile</h3>
        <br>
        <div class="card card-primary card-outline ">
            <div class="card-body  box-profile card text-center">
                <div class="card text-center">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{$LoggedUserInfo->customer_DP }}" alt="Profile Picture">
                        <h3 class="profile-username text-center"> Owner</h3>
                        <div class="form-group">
                            <label for="inputdp"> Profile Picture</label>
                            <br>
                            <input type="file" id="user_DP" name="filename" name="user_DP">
                        </div>
                    </div>
                </div>
            </div>
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Save Changes</button>
            </div>
        </div>
    </div>
</div> 
            <!-- jQuery -->
            <script src="../../plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- AdminLTE App -->
            <script src="../../dist/js/adminlte.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="../../dist/js/demo.js"></script>
            </body>
            </html>
            @endsection 