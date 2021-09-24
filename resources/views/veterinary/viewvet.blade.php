
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
  @csrf
    <div class="card-header">
      <h3 class="header">View Veterinary</h3>
      <br>
     
    <!-- Main content -->
    <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Veterinary ID</th>
      <th scope="col">Vet Name</th>
      <th scope="col">Vet Mobile</th>
      <th scope="col">Vet Telephone</th>
      <th scope="col">Vet Birthday</th>
      <th scope="col">Vet Profile </th>
      <th scope="col">Vet Address</th>
      <th scope="col">Vet Date Added</th>
      <th scope="col">Clinic </th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
     
     
    </tr>
  </thead>
  <tbody>
    @foreach ($veterinaries as $veterinary)
    <tr>
      <td>{{ $veterinary->vet_id }}</td>
      <td>{{ $veterinary->vet_name}}</td>
      <td>{{ $veterinary->vet_mobile}}</td>
      <td>{{ $veterinary->vet_tel}}</td>
      <td>{{ $veterinary->vet_birthday}}</td>
      <td> </td>
      <td>{{ $veterinary->vet_address}}</td>
      <td>{{ $veterinary->vet_dateAdded}}</td>
      <td>{{ $veterinary->clinic_name}}</td>
      <td>{{ $veterinary->vet_isActive}}</td>
        
    <td class="project-actions text-right">
                      <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewModal">
                          <i class="fas fa-folder">
                          </i>
                          View
                      </a>
</td> 
    </tr>
    @endforeach

  </tbody>
</table>
</div>
{{-- View  modal  --}}<!-- 

  <div class="modal" id="viewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">View Veterinarians</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Vet Name: Hannah Ramirez.</h5>
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
  </div> -->
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
@endsection