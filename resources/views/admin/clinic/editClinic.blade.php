@extends('layoutsAdmin.app')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
@section('content') 
@include('sweet::alert')

<link rel="stylesheet" href="/styles.css">
<script src="../lib/jquery.js"></script>
<script src="https://jqueryvalidation.org/files/lib/jquery-1.11.1.js"></script>
<script src="../dist/jquery.validate.js"></script>

<script>
  $().ready(function() {
    // validate signup form on keyup and submit
    $("#editClinicForm").validate({
      rules: {
        clinic_name: { required: true, minlength: 2 },
        owner_name: { required: true},
        clinic_mobile: { required: true, minlength: 9 },
        clinic_tel: { required: true },
        clinic_email: { required: true, email: true },
        clinic_blk: { required: true},
        clinic_street: { required: true},
        clinic_barangay: { required: true},
        clinic_city: { required: true},
        clinic_zip: { required: true, minlength: 4 }},
      messages: {
        clinic_name: { required: "Please provide Clinic Name", minlength: "Your clinic must consist of at least 2 characters"},
        owner_name: { required: "Please provide Clinic owner name"},
        clinic_mobile: { required: "Please provide Mobile No.", minlength: "Your Mobile No. must be at least 9 characters long" },
        clinic_tel: { required: "Please provide Tel No."},
        clinic_blk: { required: "Please provide Address"},
        clinic_street: { required: "Please provide Address"},
        clinic_barangay: { required: "Please provide Address"},
        clinic_city: { required: "Please provide City Address"},
        clinic_zip: { required: "Please provide ZIP address", minlength: "ZIP address must be at least 4 characters long" },
        clinic_email: { email: "Please enter a valid email address", required: "please provide email"}
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


<div class="content-wrapper">
  <br>
    
  <div class="card" style="width: auto; margin-left:20px; margin-right:20px; text-align: center; padding: 20px;">
      <a class="btn btn-error btn-sm" href="/admin/CRUDclinic" style="text-align: left;">
        <i class="fas fa-arrow-left"></i> Return </a>

      <div style="width: 300px">
        <br>
        <h3 style="font-size: 300% ">Edit Clinic</h3>
      </div>

      <form action="/admin/CRUDclinic/Edit/{{$clinics->clinic_id}}/save" method="POST" id="editClinicForm"> 
        @csrf 
        <table class="table table-striped table-hover">
        <thead>
          <tr>
            <div class="form-group">
              <td>
                <label>Clinic Name: </label>
                <input type="text" class="form-control" name="clinic_name" id="clinic_name" placeholder="Enter Clinic Name"  value="{{$clinics->clinic_name}}">
              </td>
            </div>
            <div class="form-group">
              <td>
                <label>Owner Name: </label>
                <input type="text" class="form-control" name="owner_name" id="owner_name" placeholder="Enter Owner Name"  value="{{$clinics->owner_name}}">
              </td>
            </div>
            <div class="form-group">
              <td>
                <label>Mobile No: </label>
                <input type="number" class="form-control" name="clinic_mobile" id="clinic_mobile" placeholder="Enter Mobile No"  value="{{$clinics->clinic_mobile}}">
              </td>
            </div>
          </tr>
          <tr>
            <td>
              <div class="form-group">
                <label>Telephone: </label>
                <input type="number" class="form-control" name="clinic_tel" id="clinic_tel" placeholder="Enter Telephone"  value="{{$clinics->clinic_tel}}">
              </div>
            </td>
            <td>
              <div class="form-group">
                <label>Email: </label>
                <input type="email" class="form-control" name="clinic_email" id="clinic_email" placeholder="Enter Email"  value="{{$clinics->clinic_email}}">
              </div>
            </td>
            <td>
              <div class="form-group">
                <label>House Block/Building/Floor No.: </label>
                <input type="text" class="form-control" name="clinic_blk" id="clinic_blk" placeholder="House Block/Building/Floor No."  value="{{$clinics->clinic_blk}}">
              </div>
            </td>
          <tr>
            <td>
              <div class="form-group">
                <label>Street/Highway: </label>
                <input type="text" class="form-control" name="clinic_street" id="clinic_street" placeholder="Street/Highway."  value="{{$clinics->clinic_street}}">
              </div>
            </td>
            <td>
              <div class="form-group">
                <label>Barangay: </label>
                <input type="text" class="form-control" name="clinic_barangay" id="clinic_barangay" placeholder="Barangay"  value="{{$clinics->clinic_barangay}}">
              </div>
            </td>
            <td>
              <div class="form-group">
                <label>City: </label>
                <input type="text" class="form-control" name="clinic_city" id="clinic_city" placeholder="City"  value="{{$clinics->clinic_city}}">
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="form-group">
                <label>Zip Code: </label>
                <input type="number" class="form-control" name="clinic_zip" id="clinic_zip" placeholder="Zip Code"  value="{{$clinics->clinic_zip}}">
              </div>
            </td>
            <td>
              <div class="form-group">
                <label>Clinic Active: </label>
                <select name="clinic_isActive" id="clinic_isActive" class="form-control" >
                  <option selected disabled>is this Clinic active?</option>
                  @if($clinics->clinic_isActive == 1 )
                  <option value=1 selected> Yes </option>
                  <option value=0 > No </option>
                  @else
                  <option value=0 selected> No </option>
                  <option value=1 > Yes </option>
                  @endif

                </select>
              </div>
            </td>
            <td>
            </td>
            <br>
          </tr>
        </thead>
      </table>
      <div>
        <button type="submit" class="btn btn-success btn-lg" style="text-align: center"><i class="fas fa-save"></i> Save Changes</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script>
  $("document").ready(function() {
    setTimeout(function() {
      $("#messageModal").remove();
    }, 3000);
  });
</script> 


<script>
  $("#clinic_blk").on('change', function (){
    var value = $(this).val();

    const arr = value.split(" ");

    for(var i = 0; i < arr.length; i++){
      arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);
    }
    const str2 = arr.join(" ");
    $("#clinic_blk").val(str2);
    console.log(str2);

  });
</script>

@endsection