@extends('layouts.header')
@section('title')
@parent
JFS | Activity Logs
@endsection
@section('content')

@section('content')
@parent
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('partnerDashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Activity Logs</li>
    </ol>
</nav>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>

<!-- export button -->
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

         <div style="padding: 1%"> 
            <h1><center>All Activity Logs</center></h1> 
                 <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Activity Logs</h6>
                        </div>
                

                        <div class="card-body">
                            <div class="table-responsive" id="user_table">
                         
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Email Id</th>
                                        <th>Phone No</th>
                                        <th>Creat Loan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($user as $users)

                                        <tr>
                                            <td>
                                                {{$users->id}}
                                            </td>   
                                            <td>
                                                {{ $users->name }}
                                            </td>  
                                            <td>
                                                {{$users->email_id}}
                                            </td> 
                                            <td>
                                                {{$users->mobile_no}}
                                            </td>
                                             <td>
                                                <a href=""></a><button class="btn btn-primary" type="submit" >Create Loan</button></a>
                                            </td>
                                            
                                         
                                        </tr>
                                        @endforeach
                                </tbody>
                                  
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Email Id</th>
                                        <th>Phone No</th>
                                        <th>Creat Loan</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="float-right"> 
                              
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