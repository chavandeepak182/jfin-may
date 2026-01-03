@extends('layouts.header')

@section('title')
All Users
@endsection

@section('content')

<!-- Card Header with Breadcrumbs and Buttons -->
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-2 mb-md-0">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('partnerDashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Enquiry Leads</li>
            </ol>
        </nav>

        <!-- Buttons Section -->
       <div class="d-flex" style="gap: 10px;">
    <!-- All Employee -->
    <a href="/admin/leads" class="text-decoration-none">
        <div class="custom-btn" style="height:50px; width:150px; 
            background: linear-gradient(135deg, #6a11cb, #2575fc); 
            border-radius:12px; display:flex; align-items:center; 
            justify-content:center; color:white; font-weight:bold; 
            box-shadow:0 4px 15px rgba(0,0,0,0.2);
            transition:transform 0.2s ease, box-shadow 0.2s ease;">
            <span>All Leads</span>
        </div>
    </a>

    <!-- All Channel Partner -->
    
</div>

    </div>
</div>

<!-- Hover Effect -->
<style>
    .custom-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    }
</style>


<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<!-- Export button -->
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

<div class="card shadow mb-4"> 
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="card-body">
        <table id="example" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enquiries as $enquiry)
                    <tr>
                        <td>{{ $enquiry->enquiry_id }}</td>
                        <td>{{ $enquiry->name }}</td>
                        <td>{{ $enquiry->email }}</td>
                        <td>{{ $enquiry->contact }}</td>
                        <td>{{ $enquiry->message }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script')

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>

<!-- Export button -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 

<script>
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip', // Configure buttons to appear at the top of the table
        buttons: [
            'copy', 
            'csv', 
            'excel', 
            'pdf', 
            'print' // These are the export buttons
        ]
    });
});
</script>

@endsection
