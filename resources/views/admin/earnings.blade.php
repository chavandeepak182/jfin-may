@extends('layouts.header')
@section('title')
@parent
JFS | Referral 
@endsection
@section('content')

@section('content')
@parent
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Referral Earnings</li>
    </ol>
</nav>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>

<!-- export button -->
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

         <div style="padding: 1%"> 
            <h1><center>All Users Referral Earnings</center></h1> 
                 <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Referral Users List</h6>
                        </div>
                

                        <div class="card-body">
                            <div class="table-responsive" id="user_table">
                         
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Referral Code</th>
                                        <th>Name</th>
                                        <th>Email ID</th>
                                        <th>Mobile Number</th>
                                        <th>Wallet Balance</th>
                                        <th>Date of Birth</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($data['earnings'] as $user)
                                        <tr>
                                            <td>
                                                {{$user->referral_code}}
                                            </td>   
                                            <td>
                                                {{$user->name}}
                                            </td>  
                                            <td>
                                                {{$user->email_id}}
                                            </td> 
                                            <td>
                                                {{$user->mobile_no}}
                                            </td> 
                                            <td>
                                                {{$user->wallet_balance}}
                                            </td> 
                                            <td>
                                                 {{$user->dob}}
                                            </td> 
                                           
                                            <td>
                                                <a class="btn btn-primary btn-xs edit" title="Edit"href="#"><i class="fa fa-eye"></i></a> 
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                  
                                <tfoot>
                                    <tr>
                                        <th>Referral Code</th>
                                        <th>Name</th>
                                        <th>Email ID</th>
                                        <th>Mobile Number</th>
                                        <th>Wallet Balance</th>
                                        <th>Date of Birth</th>
                                        <th>Action</th> 
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="float-right"> 
                                {{ $data['earnings']->links() }}
                            </div>
                        </div>
                </div>
            </div>
        </div>

   


   
   

@endsection

@section('script')
@parent

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>




<!--export button -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<script>

$(document).ready( function () {
    $('#example').DataTable();
} );

</script>




@endsection