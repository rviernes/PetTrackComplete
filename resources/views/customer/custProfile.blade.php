@extends('layoutsCustomer.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> @section('content') <div class="content-wrapper">
<link rel="stylesheet" href="/styles.css">    
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 id="pet_name_id">Customer Profile</h1>
                </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                    <!-- update -->
                    <div class="text-success alert-block text-center" id="update-success">
                        <strong></strong>
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                <!-- /.col -->
                <div class="col-md-12" >
                    <div class="card">
                        <div class="card-header">
                            <div class="p-2" style="width: 200px; text-align: right;">
                                        <a class="btn btn-primary btn-block" href="/user/custAcc">Edit Profile</a>
                                    <!-- <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Change Password </a></li> -->
                            </div>
                        </div>
                        <!-- /.card-header -->
                            <div class="tab-content">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">First Name</label>
                                                    <h5>{{ $LoggedUserInfo->customer_fname }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Last Name</label>
                                                    <h5>{{ $LoggedUserInfo->customer_lname }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Middle Name</label>
                                                    <h5>{{ $LoggedUserInfo->customer_mname }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Gender </label>
                                                    <h5>{{ $LoggedUserInfo->customer_gender}}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Mobile </label>
                                                    <h5>{{ $LoggedUserInfo->customer_mobile }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Telephone </label>
                                                    <h5>{{ $LoggedUserInfo->customer_tel}}</h5>
                                                </div>
                                            </td>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Blk no. </label>
                                                    <h5>{{ $LoggedUserInfo->customer_blk }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Street. </label>
                                                    <h5>{{ $LoggedUserInfo->customer_street }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Subdivision </label>
                                                    <h5>{{ $LoggedUserInfo->customer_subdivision }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Barangay </label>
                                                    <h5>{{ $LoggedUserInfo->customer_barangay }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">City </label>
                                                    <h5>{{ $LoggedUserInfo->customer_city }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Zip </label>
                                                    <h5>{{ $LoggedUserInfo->customer_zip }}</h5>
                                                </div>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="col-md-4"></div>
                                <!-- /.col -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div> @endsection
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