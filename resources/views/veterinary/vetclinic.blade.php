
@extends('layoutsvet.app')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

@section('content')
<div class="content-wrapper">
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    
    <h3 class="mt-4 mb-4">Clinic Information</h3>
    <div class="row">

      @foreach ($widgetClinic as $clinic)
        
      
      <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-info">
            <h3 class="widget-user-username">{{ $clinic->clinic_name }}</h3>
            <h5 class="widget-user-desc">The best vet clinic Eveerrr!!</h5>
          </div>
        
          <div class="card-footer p-0">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link">
                  Clinic Owner: <span class="float-right">{{ $clinic->owner_name }}</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link">
                  Mobile #:<span class="float-right ">{{ $clinic->clinic_mobile }}</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link">
                  Tel #: <span class="float-right ">{{ $clinic->clinic_tel }}</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link">
                  Email: <span class="float-right ">{{ $clinic->clinic_email }}</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link">
                  Address: <span class="float-right ">{{ $clinic->clinic_blk}},{{ $clinic->clinic_street}}, {{ $clinic->clinic_barangay}}, {{ $clinic->clinic_city}},{{ $clinic->clinic_zip}}</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!-- /.widget-user -->
      </div>
      @endforeach
      <!-- /.col -->
    </div>
    <!-- /.row -->


  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
  
</div>
  <!-- /.content-wrapper -->

 
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