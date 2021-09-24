@extends('layoutsAdmin.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
@section('content') 
@include('sweet::alert')
<link rel="stylesheet" href="/styles.css">
<div class="content-wrapper">
<br>


  <div class="card"> 
    @csrf 
    <a class="btn btn-error btn-sm" href="/admin/CRUDclinic" style="text-align: left;">
        <i class="fas fa-arrow-left"></i> Return </a>
        <h3 class="header" id="pet_name_id">Veterinary Details</h3>
      <br>
      <table class="table table-striped table-hover" id="vetDetails">
        <thead>
          <tr>
            <th>Name:</th>
            <th>Birthday:</th>
            <th>Date Added:</th>
            <th>Status:</th>
            <th>Action:</th>
          </tr>
        </thead>
        <tbody> 
          @foreach ($vetDetails as $vdetails) 
          <tr>
              <td>{{ $vdetails->vet_lname }}, {{ $vdetails->vet_fname }} {{ $vdetails->vet_mname }}</td>
              <td>{{ $vdetails->vet_birthday}}</td>
              <td>{{ $vdetails->vet_dateAdded }}</td>
              @if ($vdetails->vet_isActive == 1) 
              <td><span class="badge badge-success"> Active </span></td> 
              @else 
              <td><h6><span class="badge badge-danger">Inactive</span></td> 
              @endif

              <td>
               <h4>
                <b class="btn btn-primary view-btn" data-toggle="modal" title="View Vet Details" data-target="#viewModal{{ $vdetails->vet_id }}">
                <i class="fas fa-folder"></i>
              </b>

              <a class="btn btn-info" href="/admin/CRUDvet/Edit/{{ $vdetails->vet_id }}" title="Edit Vet Details">
                  <i class="fas fa-pencil-alt"></i>
              </a>
              <button class="btn btn-danger" data-toggle="modal"  data-target="#deleteModal{{ $vdetails->vet_id }}" title="Delete Vet">
                  <i class="fas fa-trash"></i>
                  </button>

              </td>
          </tr> 

          <!---------------------------- delete modal -------------------------------->
  <div class="modal fade" id="deleteModal{{ $vdetails->vet_id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Vet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/CRUDvet/Delete/{{ $vdetails->id }}" method="GET">
                @csrf
                <div class="modal-body">
                    <h3>Confirm deletion of Veterinarian: <br> <strong>{{ $vdetails->vet_fname }} {{ $vdetails->vet_mname }} {{ $vdetails->vet_lname }}</strong>?</h3><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect remove-data-from-delete-form">Delete</button>
                </div>
            </form>
        </div>
    </div>
  </div>
<!---------------------------- end delete modal -------------------------------->

<!-- VIEW MODAL -->
        <div id="viewModal{{ $vdetails->vet_id }}" class="modal fade" role="dialog" style="display:none">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header" style="display: inline-block;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-weight: bold;">Veterinary Details</h4>
              </div>
                <div class="modal-body" style="font-weight: bold; text-align: left; margin-right: 20px; margin-left: 20px;">
                  <h3 style="font-weight: bold;">
                    <h5>Username:  {{ $vdetails->username }}
                      <br>Mobile No.:  {{ $vdetails->user_mobile }}
                      <br>Email:  {{ $vdetails->email }}
                      <br>Address:  {{ $vdetails->vet_blk }} / {{ $vdetails->vet_street}} / {{ $vdetails->vet_subdivision}} / {{ $vdetails->vet_barangay}} / {{ $vdetails->vet_city}} / {{ $vdetails->vet_zip}}
                      <br>Mobile #:  {{ $vdetails->vet_mobile}}
                      <br>Tel. #:  {{ $vdetails->vet_tel}}
                      <br>Birthday:  {{ $vdetails->vet_birthday}}
                    </h5>
                  </h3>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-dismiss="modal" id="CloseBtn">Close</button>
                </div>
          </div>
        </div>
      </div>
      <!-- END VIEW MODAL -->

          @endforeach 
       </tbody>
      </table>
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
  <script src="{{asset('vendors/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
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
@endsection