@extends('layouts.header')

@section('title')
@parent
JFS | Leads
@endsection

@section('content')
<!-- Stylesheets for DataTables -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <!-- Breadcrumbs -->
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Leads</li>
                </ol>
            </nav>
            <a href="{{ route('leads.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Add Lead</a>
            <!-- Search Bar -->
            <!-- <div class="d-flex ms-auto">
                <input type="text" id="search" class="form-control" placeholder="Search..." onkeyup="searchLead()">
            </div> -->
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="leads_table">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th> <!-- Index Column -->
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Lead Source</th>
                        <th>Follow Up Date</th>
                        <th>Assigned To</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $index => $lead)
                    <tr>
                        <td>{{ $leads->firstItem() + $index }}</td> <!-- Serial Number -->
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->phone }}</td>
                        <td>{{ $lead->lead_source }}</td>
                        <td>{{ \Carbon\Carbon::parse($lead->follow_up_date)->format('d M Y') }}</td>
                        <td>{{ $lead->agent->name ?? 'N/A' }}</td>
                        <td>
                            <a class="btn btn-info btn-xs view" title="View" href="{{ route('leads.show', $lead->id) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-warning btn-xs edit" title="Edit" href="{{ route('leads.edit', $lead->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs delete" title="Delete" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th> <!-- Index Column -->
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Lead Source</th>
                        <th>Follow Up Date</th>
                        <th>Assigned To</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            <div class="float-right"> 
                {{ $leads->links() }}
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
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function () {
    $('#example').DataTable();
});
</script>

@endsection
