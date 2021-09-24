@extends('layoutsvet.app')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

@section('content')
  <!-- Content Wrapper. Contains page content -->

  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
        
          </div><!-- /.col -->
          <div class="col-sm-lg">
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
      <h3 class="card-title">Assign Veterinary /Clinic</h3>
  
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0">
      <table style="table-layout: fixed; width: 100%;" class="table table-striped projects">
  <thead>
    <tr>
    <th style="width:80px; scope="col">Vet ID</th>
      <th style="width:100px; scope="col">Vet Name</th>
      <th style="width:120px; scope="col">Vet Address</th>
      <th style="width:100px; scope="col">Pet ID</th>
      <th style="width:100px;scope="col">Pet Name</th>
      <th style="width:180px;scope="col">Pet Registered Date</th>
      <th style="width:130px;scope="col">Customer ID</th>
      <th style="width:100px;scope="col">Status</th>
      <th style="width:200px;scope="col">Action</th>


     
    </tr>
  </thead>
  <tbody>
  <td>
    
    </td>
    <td>
    
    </td>
    <td>
    
    </td>
    <td>
    
    </td>
    <td>
    
    </td>
    
    <td>
    
    </td>
    <td>
    
    </td>
    <td>
    
    </td>
    
    
    <td class="project-actions text-right">
                      <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewModal">
                          <i class="fas fa-folder">
                          </i>
                          View
                      </a>
                      <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Edit
                      </a>
                      <a class="btn btn-danger btn-sm" href="#">
                          <i class="fas fa-trash">
                          </i>
                          Delete
                      </a>
                  </td> 

  </tbody>
</table>
</div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

  {{-- View  modal  --}}

  <div class="modal" id="viewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">View Veterinary / Clinic</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Pet Name: Hannah Ramirez.</h5>
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


  {{-- end view modal --}}
   
    <!-- edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Veterinary / Clinic</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="" method="POST">
        <div class="modal-body">

      
                <div class="form-group">
                  <label for="exampleInputEmail1">Vet Name</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Vet Name">
                  
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Vet Address</label>
                  <textarea placeholder="Enter Address" class="form-control"aria-describedby="namelHelp"id="inputnotes"  name="notes" >
                   </textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Pet ID</label>
                  <select id="inputStatus" class="form-control custom-select">
                  <option selected disabled>Choose...</option>
                  <option>...</option>
                  <option>...</option>
                </select>
             
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Pet Name</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Pet Name">
                </div>
              
                 
                <div class="form-group">
                  <label for="exampleInputEmail1">Pet Registered Date</label>
                  <input type="date" class="form-control" id="date" >
                  
                </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Customer ID</label>
                <select id="inputStatus" class="form-control custom-select">
                  <option selected disabled>Choose...</option>
                  <option>...</option>
                  <option>...</option>
                </select>
                
              </div>

              

              <div class="form-group">
                <label for="exampleInputEmail1">Status</label>
                <select id="inputStatus" class="form-control custom-select">
                  <option selected disabled>is Pet Active?</option>
                  <option>Yes</option>
                  <option>No</option>
                </select>
                
              </div>

             
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Update</button>
        </div>
      </div>
    </div>
  </div>

  {{-- end edit modal  --}}

  <!-- Button trigger modal -->
  <div class = "d-grid gap-2 d-md-flex justify-content-md-end">
    <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#addModal">
    <i class="fas fa-save"> Assign Vet / Clinic
    
        </i>
      </button>
      </div>
  

   

  <!-- Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Assign a Veterinary / Clinic</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="" method="POST">
        <div class="modal-body">

       
        <div class="form-group">
    <label for="inputvetname" class="form-label">Vet Name</label>
    <input type="name" required placeholder="Enter Name" class="form-control" id="inputvetname">
  </div>
  <div class="form-group">
    <label for="inputvetAdd" class="form-label">Vet Address</label>
    <input type="name" required placeholder="Enter Name" class="form-control" id="inputvetAdd">
  </div>
  <div class="form-group">
  <label for="inputPetID">Pet ID</label>
                <select id="inputPetID" class="form-control custom-select">
                  <option selected disabled>Choose Pet ID</option>
                  <option>...</option>
                  <option>...</option>
                </select>
  </div>
  <div class="form-group">
  <label for="inputPetname">Pet Name</label>
                <select id="inputPetID" class="form-control custom-select">
                  <option selected disabled>Choose Pet Name</option>
                  <option>...</option>
                  <option>...</option>
                </select>
  </div>
  <div class="form-group">
    <label for="date" required class="form-label"> Registered Date</label>
    <br>
    <div class="col-sm-12">
    <input type="date" class="form-control" id="date" >
  </div>
</div>
  <div class="form-group">
  <label for="inputPetname">Customer ID</label>
                <select id="inputPetID" class="form-control custom-select">
                  <option selected disabled>Choose Customer ID</option>
                  <option>...</option>
                  <option>...</option>
                </select>
  </div>
  <div class="form-group">
  <label for="inputPetname">Status</label>
                <select id="inputStatus" class="form-control custom-select">
                  <option selected disabled>is Pet Active?</option>
                  <option>Yes</option>
                  <option>No</option>
                </select>
  </div>

<div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Register</button>
        </div>
      </div>
    </div>
  </div>

  {{-- end add modal  --}}

  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

  @endsection