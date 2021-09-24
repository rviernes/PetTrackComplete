@extends('layoutsvet.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> @section('content') @csrf <div class="content-wrapper">
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
    {{-- <a class="btn btn-success btn-sm " data-toggle="modal" data-target="#addModal" style="margin-left: 10px">
			<i class="fas fa-save"></i> Add Customer 
		
		</a>
		<br> --}}
    <br>
    <form action="{{ route('vet.custsearch') }}" method="get">
        <div class="input-group" style="width: 400px; margin-left: 500px">
            <input type="search" class="form-control rounded" placeholder="Search...." aria-label="Search" name="custsearch" style="width: 200px;" />
            <button type="submit" class="btn btn-outline-primary">search</button>
            <br>
        </div>
    </form>
    <a class="btn btn-success btn-sm" style="margin-left: 20px" href="/veterinary/registercustomer">
        <i class="fas fa-user"></i> Register Customer </a>
    <br>
    <br>
    <!-- Default box --> @if(Session::has('customer_deleted')) <div class="alert alert-danger" role="alert" id="messageModal">
        {{ Session::get('customer_deleted') }}
    </div> @endif @if(Session::has('newCustomer')) <div class="alert alert-success" role="alert" id="messageModal">
        {{ Session::get('newCustomer') }}
    </div> @endif @if(Session::has('success')) <div class="alert alert-success" role="alert" id="messageModal">
        {{ Session::get('success') }}
    </div> @endif @if(Session::has('warning')) <div class="alert alert-warning" role="alert" id="messageModal">
        {{ Session::get('warning') }}
    </div> @endif @if(Session::has('error')) <div class="alert alert-danger" role="alert" id="messageModal">
        {{ Session::get('error') }}
    </div> @endif <div class="card"> @csrf <div class="card-header">
            <h3 class="header">Customer</h3>
            <br>
            <!-- Main content -->
            <table class="table  table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="width:5%">#</th>
                        <th scope="col" style="width:8%"> Name</th>
                        <th scope="col" style="width:5%">Mobile</th>
                        <th scope="col" style="width:5%">Telephone</th>
                        <th scope="col" style="width:5%">Gender</th>
                        <th scope="col" style="width:5%">Birthday</th>
                        {{-- <th scope="col"style="width:10%">Customer Profile</th> --}}
                        <th scope="col" style="width:20%">Address</th>
                        <th scope="col" style="width:8%">Status</th>
                        <th scope="col" style="width:18%">Action</th>
                    </tr>
                </thead>
                <tbody> @foreach ($customers as $customer) <tr>
                        <td>{{ $customer->customer_id}}</td>
                        <td>{{ $customer->customer_name}}</td>
                        <td>{{ $customer->customer_mobile}}</td>
                        <td>{{ $customer->customer_tel}}</td>
                        <td>{{ $customer->customer_gender}}</td>
                        <td>{{ $customer->customer_birthday}}</td>
                        <td>{{ $customer->customer_address}}</td> @if ($customer->customer_isActive == 1) <td>
                            <span class="badge badge-success">Yes</span>
                        </td> @else <td>
                            <span class="badge badge-danger">No</span>
                        </td> @endif <td class="project-actions text-right">
                            <a href="/veterinary/viewpatient/{{ base64_encode($customer->customer_id)}}" class="btn btn-primary btn-sm">
                                <i class="fas fa-folder"></i> View </a>
                            <a href="/veterinary/veteditcustomer/{{ $customer->customer_id}}" class="btn btn-info btn-sm">
                                <i class="fas fa-pencil-alt"></i> Edit </a>
                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $customer->customer_id }}">
                                <i class="fas fa-trash"></i> Delete </a>
                            <a class="btn btn-success btn-sm" href="/veterinary/registerpet/{{ $customer->customer_id}}">
                                <i class="fas fa-paw"></i> Add Pets </a>
                        </td>
                    </tr>
                    {{-- delete warning modal --}}
                    <div class="modal fade" id="deleteModal{{ $customer->customer_id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/veterinary/delete-viewvetcustomer/{{ $customer->customer_id}}" method="GET">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <h3>Delete Customer?</h3>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger waves-effect remove-data-from-delete-form">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> @endforeach
                </tbody>
            </table>
            {{ $customers->links('pagination::bootstrap-4') }}
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
</script> @endsection