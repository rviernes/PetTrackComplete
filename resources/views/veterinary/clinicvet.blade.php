
@extends('layoutsvet.app')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
        <a class="btn btn-error btn-sm" href="/veterinary/viewvetclinic">
            <i class="fas fa-arrow-left">
            </i>
            Return
        </a>
      <h3 class="header">Veterinarians</h3>
      <br>
     

    <!-- Main content -->
    <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th width="10%" scope="col">Veterinarian ID</th>
      <th scope="col">Name</th>
      <th scope="col">Mobile</th>
      <th scope="col">Telephone</th>
      <th scope="col">Birthday</th>
      <th width="20%"scope="col">Address</th>
      <th scope="col">Date Added</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
     
    </tr>
  </thead>
  <tbody>
    @foreach ($clinicVets as $vet)
  <tr>
    <td>{{ $vet->vet_id }}</td>
    <td>{{ $vet->vet_name }}</td>
    <td>{{ $vet->vet_mobile }}</td>
    <td>{{ $vet->vet_tel }}</td>
    <td>{{ $vet->vet_birthday }}</td>
    <td>{{ $vet->vet_address }}</td>
    <td>{{ $vet->vet_dateAdded }}</td>
    @if ($vet->vet_isActive=="1")
    <td><span class="badge badge-success">Yes</span></td>
    @else
    <td><span class="badge badge-error">No </span></td>
    @endif
    

  
    <td class="project-actions text-right">
                      <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewModal">
                          <i class="fas fa-folder">
                          </i>
                          View
                      </a>
</td>
    <!-- <td>
    <a class="btn btn-info" href="#" role="button">Update </a>
    <button type="button" class="btn btn-danger">Delete </button>
<button class="btn btn-dark" type="submit">View  </button>
    </td> -->

  </tr>
  @endforeach
  </tbody>
</table>
</div>
{{-- View  modal  --}}

  <div class="modal" id="viewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">View Clinic</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Clinic Name: Hannah Ramirez.</h5>
          <h5>Gender: male.</h5>
          <h5>Birthday: 09-15-2000.</h5>
          <h5>Notes: Vincent Lagria.</h5>
          <h5>Bloodtype: A</h5>
          <h5>Registered Date: 06-14-2021</h5>
        </div>
        <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
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
@endsection