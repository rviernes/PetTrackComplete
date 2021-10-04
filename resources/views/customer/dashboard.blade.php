@extends('layoutsCustomer.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
@section('content') 
<link rel="stylesheet" href="/styles.css">
@include('sweet::alert')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <h4 id="pet_name_id"> PETS </h4>
        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">
                <div class="row">
                @foreach ($petinfo as $info)
                    <div class="col-md-4">
                        <!-- Widget: user widget style 1 -->
                        <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            
                            <div class="widget-user-header bg-grey">
                                <h1 class="widget-user-username">{{$info->pet_name}}</h1>
                            </div>
                             
                            

                            <div class="card-footer p-0">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" style="text-align: left;"> Name: <span class="float-right">{{$info->pet_name}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" style="text-align: left;"> Birthday: <span class="float-right ">{{$info->pet_birthday}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" style="text-align: left;"> Gender: <span class="float-right ">{{$info->pet_gender }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" style="text-align: left;"> Bloodtype: <span class="float-right ">{{$info->pet_bloodType}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" style="text-align: left;">
                                        <a class="nav-link"> Date Registered: <span class="float-right">{{$info->pet_registeredDate}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" style="text-align: left;">
                                        <a class="nav-link"> Notes: <span class="float-right ">{{$info->pet_notes}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" style="text-align: left;">
                                      @if ($info->pet_isActive==1)
                                        <a class="nav-link"> Status: <span class="float-right ">Active</span></a>
                                      @elseif ($info->pet_isActive == 2)
                                        <a class="nav-link"> Status: <span class="float-right ">Inactive</span>
                                        </a>
                                      @endif
                                    </li>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                    @endforeach
                    <!-- /.col -->
                </div>
                <!-- /.card-footer -->
                <!-- /.row --> @endsection
                <!-- jQuery -->
                <script src="../../plugins/jquery/jquery.min.js"></script>
                <!-- Bootstrap 4 -->
                <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                <!-- AdminLTE App -->
                <script src="../../dist/js/adminlte.min.js"></script>
                <!-- AdminLTE for demo purposes -->
                <script src="../../dist/js/demo.js"></script>
                </body>
                </html>