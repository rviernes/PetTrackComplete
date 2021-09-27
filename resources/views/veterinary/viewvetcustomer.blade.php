@extends('layoutsVet.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
@section('content') 
@include('sweet::alert')
@csrf 
<link rel="stylesheet" href="/styles.css">
<div class="content-wrapper">

    <!-- /.content-header -->
    <br>
    
    <!-- <a class="btn btn-success btn-sm" style="margin-left: 20px" href="/veterinary/registerCustomer">
        <i class="fas fa-user"></i> Register Customer </a> -->
    <!-- Default box --> 
    @if(Session::has('customer_deleted')) <div class="alert alert-danger" role="alert" id="messageModal">
        {{ Session::get('customer_deleted') }}
    </div> @endif @if(Session::has('newCustomer')) <div class="alert alert-success" role="alert" id="messageModal">
        {{ Session::get('newCustomer') }}
    </div> @endif @if(Session::has('success')) <div class="alert alert-success" role="alert" id="messageModal">
        {{ Session::get('success') }}
    </div> @endif @if(Session::has('warning')) <div class="alert alert-warning" role="alert" id="messageModal">
        {{ Session::get('warning') }}
    </div> @endif @if(Session::has('error')) <div class="alert alert-danger" role="alert" id="messageModal">
        {{ Session::get('error') }}
    </div> 
    @endif 
    
    <div class="card"> 
        
        @csrf 
            <h3 class="header" id="pet_name_id">Customer</h3>
            <br>
            <!-- Main content -->
            <table class="table  table-striped table-hover">
                <thead>
                    <tr>
                        <th> Name </th>
                        <th> Mobile </th>
                        <th> Telephone </th>
                        <th> Gender </th>
                        <th> Birthday </th>
                        <th> Address </th>
                        <th> Status </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody> @foreach ($customers as $customer) <tr>
                        <td>{{ $customer->customer_name }}</td>
                        <td>{{ $customer->customer_mobile}}</td>
                        <td>{{ $customer->customer_tel}}</td>
                        <td>{{ $customer->customer_gender}}</td>
                        <td>{{ $customer->customer_birthday}}</td>
                        <td>{{ $customer->customer_address}}</td> 
                        
                        @if ($customer->customer_isActive == 1) 
                            <td>
                                <span class="badge badge-success">Yes</span>
                            </td> 
                        @else 
                            <td>
                                <span class="badge badge-danger">No</span>
                            </td> 
                        @endif 
                        
                        <td>
                            <a href="/veterinary/viewpatient/{{ base64_encode($customer->customer_id)}}" title="View Customer" class="btn btn-primary ">
                                <i class="fas fa-folder"></i></a>
                            <a href="/veterinary/veteditcustomer/{{ $customer->customer_id}}" title="Edit Customer" class="btn btn-info ">
                                <i class="fas fa-pencil-alt"></i></a>
                            <a class="btn btn-danger " data-toggle="modal"  data-target="#deleteModal{{ $customer->customer_id }}">
                                <i class="fas fa-trash"></i></a>
                            <a class="btn btn-success " title="Add Pets" href="/veterinary/registerpet/{{ $customer->customer_id}}">
                                <i class="fas fa-paw"></i></a>
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