@extends('layoutsAdmin.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

@section('content') 

@include('sweet::alert')

<!-- <script>
    $(document).on('click', '.update_student', function(e) {
        e.preventDefault();
        var user_id = $('#user_id').val();
        var data = {
          'username' : $('#user_name').val(),
          'email'    : $('#user_email').val(),
          'password' : $('#user_password').val(),
          'phone'    : $('#user_mobile').val(),
        }

        $.ajax({
          type: "PUT",
          url: "/admin/CRUDusers/Edit/"+user_id+"/save",
          data: data,
          dataType: "json",Success
          success: function (response){
            // console.log(response);
            if (response.status == 400) {
                alert()->warning('ErrorErrorError','Error');
            }else if(response.status == 404) {
                alert()->success('SuccessSuccessSuccess','Success');
            }else{

            }
          }
        });
    });
</script> -->

<link rel="stylesheet" href="/styles.css">
<div class="content-wrapper">
  <br>

  <div class="card">
    <a class="btn btn-error btn-sm" href="/admin/CRUDusers" style="text-align: left;">
      <i class="fas fa-arrow-left"></i> Return </a>
    <div>
      <h3 class="header" id="pet_name_id">Edit User</h3>
    </div>
    <br>
    <form action="/admin/CRUDusers/Edit/{{ $users->id }}/save" method="POST" id="editForm"> 
      @csrf 
      <table class="table table-striped table-hover" >
        <thead>
              <input type="text" id="user_id" name="user_id" value="{{ $users->id }}" hidden>
                <tr>
                  <td style="width: auto; text-align: left; margin: auto;">
                    <label>Username: </label>
                    <input type="text"  name="user_name" id="user_name" class="form-control" placeholder="Enter Username" value="{{ $users->username }}" >
                    <span class="text-danger error-text customer_fname_error" id="messageModal">@error('user_name'){{ $message }}@enderror</span>
                  </td>
                  <td style="width: auto; text-align: left; margin: auto;">
                    <label>Password: </label>
                    <input type="password"  name="user_password" id="user_password" class="form-control" placeholder="Enter Password" value="">
                    </td>
                </div>
                  <td style="width: auto; text-align: left; margin: auto;">
                    <label>Mobile No: </label>
                    <input type="text"  name="user_mobile" id="user_mobile" class="form-control" placeholder="Enter Mobile No" value="{{ $users->phone }}">
                    </td>
                </tr>
                  <tr>
                    <td style="width: auto; text-align: left; margin: auto;">
                    <label >Email: </label>
                    <input type="email"  name="user_email" id="user_email" class="form-control" placeholder="Enter Email" value="{{ $users->email }}">
                    <span class="text-danger error-text customer_fname_error" id="messageModal">@error('user_email'){{ $message }}@enderror</span>
                    </td>
                    <td style="width: auto; text-align: left; margin: auto;">
                    <label >Usertype: </label> 
                      @if($users->usertype == 'admin') 
                        <input name="userType" id="userType" class="form-control" value="admin" readonly> 
                        @elseif($users->userType_id == 'veterinary')
                        <input name="userType" id="userType" class="form-control" value="veterinary" readonly> 
                        @else
                        <input name="userType" id="userType" class="form-control" value="customer" readonly> 
                      @endif 
              </div>
              <br>
            </td>
          </tr>
        </thead>
      </table>
      <div>
      <button type="submit" class="btn btn-success btn-lg updateButton"  id="formSubmit"><i class="fas fa-save"></i> Save Changes</button>
      </div>
    </form>
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
    $("#editForm").validate({
      rules: {
        user_name: { required: true, minlength: 2, maxlength: 15 }, //minlength: 2, max: 15
        user_mobile: { required: true, minlength: 9, maxlength: 13 }, //minlength of 9 and max of 13
        user_password: { required: true, minlength: 5, maxlength: 20 }, //minlength of 5 and max of 20
        user_email: { required: true, email: true } //required email, email must have '@'
      },
      messages: {
        user_name: { required: "Please enter a username", minlength: "Min. Char: 2", maxlength: "Max Char: 15"},
        user_mobile: { required: "Mobile # needed" },
        user_password: { required: "Please provide a password", minlength: "Min. Char: 5" },
        user_email: "Email address needed"
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

  <script>
    $("document").ready(function(){
      setTimeout(function(){
        $("#messageModal").remove();
      }, 3000 );
    });
  </script>
  

@endsection