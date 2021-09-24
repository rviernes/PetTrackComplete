@extends('layoutsvet.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> @section('content') <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"></ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="header">Dashboard</h3>
            <br>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $countPet }}</h3>
                                    <p>Pet Registered</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="/veterinary/viewvetpatient" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>0</h3>
                                    <p>Appointment</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $countCustomers }}</h3>
                                    <p>Customers</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="viewvetcustomer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $countClinic }}</h3>
                                    <p>Clinic Registered</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="viewvetclinic" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Pet Registration</h5>
                                            <p class="card-text"> Register a pet and record its health condition. </p>
                                            <a href="/veterinary/viewvetcustomer" class="card-link">Register a Pet </a>
                                            <a href="viewvetpatient" class="card-link">View Health Condition of Pet</a>
                                        </div>
                                    </div>
                                    <div class="card card-primary card-outline">
                                        <div class="card-body">
                                            <h5 class="card-title">Pet Information</h5>
                                            <p class="card-text"> Update pet information and health condition . </p>
                                            <a href="/veterinary/viewvetcustomer" class="card-link">Update Pet Information</a>
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <h5 class="m-0">Featured</h5>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">Featured Pets</h6>
                                            <p class="card-text">Another set of cute pets of our lovely clients.</p>
                                            <div class="media">
                                                <img src="{{ asset('vendors/dist/img/pets2.jpg') }}" alt="User Avatar" class="img-size-100 img-square mr-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-md-6 -->
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="m-0">Featured</h5>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">Featured Pets</h6>
                                            <p class="card-text">These are the pets of our clients.</p>
                                            <div class="media">
                                                <img src="{{ asset('vendors/dist/img/pets.jpg') }}" alt="User Avatar" class="img-size-100 img-square mr-3">
                                            </div>
                                            <div class="content">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="card">
                                                                <div class="card-header border-0">
                                                                    <div class="d-flex justify-content-between">
                                                                        <h3 class="card-title">Number of Patients</h3>
                                                                        <a href="viewvetpatient">View Patients</a>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="d-flex">
                                                                        <p class="d-flex flex-column">
                                                                            <span class="text-bold text-lg">0</span>
                                                                            <span>Patients that is registered</span>
                                                                        </p>
                                                                        <p class="ml-auto d-flex flex-column text-right">
                                                                            <span class="text-success">
                                                                                <i class="fas fa-arrow-up"></i> 12.5% </span>
                                                                            <span class="text-muted">Since last week</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.col-md-6 -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.container-fluid -->
                                        </div>
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
                                    <script src="../../dist/js/demo.js"></script> @endsection