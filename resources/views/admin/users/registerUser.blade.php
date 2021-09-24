@extends('layoutsAdmin.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@section('content') 
@include('sweet::alert')
<link rel="stylesheet" href="/styles.css">

<div class="content-wrapper">
  <br>

    <!-- Default box -->
    <div class="card" >
          <a class="btn btn-error btn-sm modalFD" href="/admin/CRUDusers">
              <i class="fas fa-arrow-left"></i> Return </a>
          <div> 
              <h3 class="header" id="pet_name_id">Register User</h3>
          </div>
          <br>
          <form action="{{ route('admin.addadminsubmit') }}" method="POST" id="regForm">
            @csrf 
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <td>
                    <label for="user_name">Username: </label>
                    <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Username" value="{{ old('user_name')}}">
                    <span class="text-danger error-text user_name_error">@error('user_name'){{ $message }}@enderror</span>
                  </td>
                      <td>
                          <label for="user_password">Password: </label>
                          <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter Password" value="{{ old('user_password')}}">
                        
                      </td>
                       <td>
                          <label for="user_mobile">Mobile No: </label>
                          <input type="text" name="user_mobile" id="user_mobile" class="form-control" placeholder="Enter Mobile No" value="{{ old('user_mobile')}}">
                   </td>   
                    </tr>
                        <tr>
                        <td>
                          <label for="user_email">Email: </label>
                          <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Enter Email" value="{{ old('user_email')}}">
                          <span class="text-danger error-text user_name_error">@error('user_email'){{ $message }}@enderror</span>
                        </td>
                        <td>
                          <label for="inputStatus">Usertype:</label>
                          <select name="userType" class="form-control">
                            <option value="admin" selected>ADMIN</option>
                            <option value="veterinary">VETERINARY</option>
                            <option value="customer">CUSTOMER</option>
                          </select>
                          </td>
                        </tr>
                      </div>
                      <br>
                    </div>
                    <br>
                  </td>
              </thead>
            </table>
            <br>
            <button type="submit" class="btn btn-success btn-lg" style="text-align: center; margin-top: -25px"><i class="fas fa-save"></i> Save Changes</button>
          </form>
        </div>
      </div>
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


<script src="https://jqueryvalidation.org/files/lib/jquery.js"></script>
<script src="https://jqueryvalidation.org/files/lib/jquery-1.11.1.js"></script>
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
<script>
  $().ready(function() {
      // validate signup form on keyup and submit
      $("#regForm").validate({
          rules: { //regulations needed to be followed
              user_name: {
                  required: true,
                  minlength: 2,
                  maxlength: 15
              }, //minlength: 2, max: 15  
              user_mobile: {
                  required: true,
                  digit: true,
                  minlength: 9,
                  maxlength: 13
              }, //minlength of 9 and max of 13 
              user_password: {
                  required: true,
                  minlength: 8,
                  maxlength: 20
              }, //minlength of 5 and max of 20
              user_email: {
                  required: true,
                  email: true
              } //required email, email must have '@'
          },
          messages: { //messages for the rules
              user_name: {
                  required: "Please enter a username",
                  minlength: "Min. Char: 2",
                  maxlength: "Max Char: 15"
              },
              user_mobile: {
                  required: "Please provide a mobile #",
                  digit: "Please Enter digits only",
                  minlength: "Min #: 9",
                  maxlength: "Max #: 13"
              },
              user_password: {
                  required: "Please provide a password",
                  minlength: "Min Password: 8",
                  maxlength: "Max Password: 20"
              },
              user_email: {
                  required: "Please enter email address",
                  email: "Please enter valid email"
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script> // script for timeout modal
  $("document").ready(function() {
      setTimeout(function() {
          $("#messageModal").remove();
      }, 3000);
  });
</script> @endsection