@extends('layoutsCustomer.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 

@section('content')
@include('sweet::alert')
<div class="content-wrapper">
  <br>
  <div class="card" style="width: auto; margin-left:20px; margin-right:20px; text-align: left; padding: 20px"> 
    <div class="card-header">
      <h3 class="header" style="font-size: 300%">Pets</h3>
      <br>
      </div>
      
      <table class="table  table-striped table-hover" style="margin: auto;">
        <thead>
          <tr>
            <th> Name</th>
            <th> Gender</th>
            <th>Birthday</th>
            <th> Notes</th>
            <th> Blood Type</th>
            <th> Registered Date</th>
            <th> Type </th>
            <th> Breed </th>
            <th>Clinic </th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody> 
          <tr>
            @foreach ($petinfo as $owner)
            <td>{{ $owner->pet_name }}</td>
            <td>{{ $owner->pet_gender }}</td>
            <td>{{ $owner->pet_birthday }}</td>
            <td>{{ $owner->pet_notes }}</td>
            <td>{{ $owner->pet_bloodType }}</td>
            <td>{{ $owner->pet_registeredDate }}</td>
            <td>{{ $owner->type_name }}</td>
            <td>{{ $owner->breed_name }}</td>
            <td>{{ $owner->clinic_name }}</td>
            @if ($owner->pet_isActive == 1)
              <td><span class="badge badge-success">Active</span></td>
            @else
              <td><span class="badge badge-danger">Inactive</span></td>
            @endif
          </tr>{{-- View  modal  --}}
                    <div class="modal" id="viewModal{{ $owner->pet_id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title">Patient {{$owner->pet_name}} </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                    <h5>Pet name:        <br><strong> {{ $owner->pet_name }}            </strong></h5>
                                    </div>
                                    <div class="col-md-4">
                                    <h5>Gender:          <br><strong> {{ $owner->pet_gender }}          </strong></h5>
                                    </div>
                                    <div class="col-md-4">
                                    <h5>Birthdate: <br><strong> {{ $owner->pet_birthday }}  </strong></h5>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-md-4">
                                    <h5>Type:        <br><strong> {{ $owner->type_name }}            </strong></h5>
                                    </div>
                                    <div class="col-md-4">
                                    <h5>Breed:           <br><strong> {{ $owner->breed_name }}          </strong></h5>
                                    </div>
                                    <div class="col-md-4">
                                    <h5>Registered date: <br><strong> {{ $owner->pet_registeredDate }}  </strong></h5>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                    <h5>Owner:           <br><strong> {{ $owner->customer_name }} </strong></h5>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-4">
                                    <h5>Blood type:          <br><strong> {{ $owner->pet_bloodType }}          </strong></h5>
                                    </div>
                                </div>

                                <div style="text-align: center;">
                                    <div class="col-md-12" style="color: blue;">
                                    <h5>Pet prescription:         <strong> "{{ $owner->pet_notes }}"    </strong>
                                    </div>
                                <br>
                                    <h6>Address:         <strong> {{ $owner->customer_address }}    </strong></h5>
                                    @if ($owner->pet_isActive == "1") 
                                    <h5>Status : <strong> Active </strong></h5>
                                    @else 
                                    <h5>Status : <strong> Inactive </strong></h5> 
                                    @endif 
                                    <h5 style="text-align: center;"> 
                                        {!! QrCode::size(150)->eyeColor(0, 255, 255, 255, 0, 0, 0)->generate('name: '.$owner->pet_name. ' Gender: '.$owner->pet_gender. ' Type: '.$owner->type_name. ' Breed: '.$owner->breed_name. ' Registered Date: '. $owner->pet_registeredDate. ' Owner: '.$owner->clinic_name . ' Address: '.$owner->customer_address); !!} <br>
                                        <strong>Scan Me</strong>
                                    </h5>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end view modal --}}

<!-- DELETE MODAL -->
      <div class="modal fade" id="deleteModal{{ $owner->pet_id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Pet</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action=" /admin/viewPatient/delete/{{ $owner->pet_id }} " method="GET">
              {{ csrf_field() }}
              <div class="modal-body">
                <h3>Confirm data deletion of pet, <strong>{{ $owner->pet_name }}</strong>?</h3>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger waves-effect remove-data-from-delete-form">Delete</button>
              </div>
            </form>
          </div>
        </div>
      </div>

          </div>
        @endforeach    
        </tbody>
      </table>
    </div>
  </div>
</div>
{{-- end edit modal  --}}

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script> 
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous">
</script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script>
  $("document").ready(function() {
    setTimeout(function() {
      $("#messageModal").remove();
    }, 3000);
  });
</script>
@endsection