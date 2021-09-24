@extends('layoutsvet.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> @section('content') <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Veterinary Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="custProfile">Profile</a>
                        </li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- update -->
                    <div class="text-success alert-block text-center" id="update-success">
                        <strong></strong>
                    </div>
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{asset('vendors/dist/img/han.jpg') }}" alt="hannah">
                            </div>
                            <br>
                            <h5 style="text-align: center">Dr. {{ $LoggedUserInfo->vet_lname }}, {{ $LoggedUserInfo->vet_fname }} {{ $LoggedUserInfo->vet_mname }} </h5>
                            <br>
                            <a href="/veterinary/editprofile" class="btn btn-primary btn-block">
                                <b>Edit Profile </b>
                            </a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            @if(Session::has('success')) 
                             <div class="alert alert-success" role="alert" id="messageModal">
                                {{ Session::get('success') }}
                            </div> 
                            @endif
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#listofpets" data-toggle="tab">Vet Info</a>
                                </li>
                                <!-- <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Change Password </a></li> -->
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!--  -->
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">First Name</label>
                                                    <h5>{{ $LoggedUserInfo->vet_fname }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Last Name</label>
                                                    <h5>{{ $LoggedUserInfo->vet_lname }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Middle Name</label>
                                                    <h5>{{ $LoggedUserInfo->vet_mname }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Mobile </label>
                                                    <h5>{{ $LoggedUserInfo->vet_mobile }}</h5>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Blk no. </label>
                                                    <h5>{{ $LoggedUserInfo->vet_blk }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Street </label>
                                                    <h5>{{ $LoggedUserInfo->vet_street }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Subdivision </label>
                                                    <h5>{{ $LoggedUserInfo->vet_subdivision }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Subdivision </label>
                                                    <h5>{{ $LoggedUserInfo->vet_barangay }}</h5>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">City </label>
                                                    <h5>{{ $LoggedUserInfo->vet_city }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Zipcode </label>
                                                    <h5>{{ $LoggedUserInfo->vet_zip }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="">Date Added </label>
                                                    <h5>{{ $LoggedUserInfo->vet_dateAdded }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label for="">Status </label> @if ($LoggedUserInfo->vet_isActive == "1") <h5>Active</h5> @else <h5>Inactive</h5> @endif
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
</body>
</html>