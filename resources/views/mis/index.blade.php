@extends('layouts.header')

@section('title')
@parent
MIS Dashboard
@endsection

@section('content')
@parent
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">
        <nav aria-label="breadcrumb" class="d-flex align-items-center">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">MIS Dashboard</li>
            </ol>
        </nav>

        <div class="d-flex ms-auto">
            <input type="text" id="search" class="form-control" placeholder="Search..." onkeyup="searchMIS()">
        </div>

        <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#addMISView">
            <i class="fa fa-plus"></i> Add Mis
        </button>
    </div>
</div>
<div class="d-flex justify-content-end mb-3">
    <button class="btn btn-success" id="exportExcel">Export to Excel</button>
    <!-- <button class="btn btn-danger ms-3" id="exportPDF">Export to PDF</button> -->
</div>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{ asset('theme') }}/dist-assets/css/sb-admin-2.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card pt-3">
            <div class="card-body">
                <div class="table-responsive" id="mis_table">
                    <table class="table" id="misDataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Product Type</th>
                                <th>Amount</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="mis_table_body">
                            @foreach($misRecords as $mis)
                            <tr>
                                <td>{{ $mis->id }}</td>
                                <td>{{ $mis->name }}</td>
                                <td>{{ $mis->email }}</td>
                                <td>{{ $mis->contact }}</td>
                                <td>{{ $mis->product_type }}</td>
                                <td>{{ $mis->amount }}</td>
                                <td>{{ $mis->city }}</td>
                                <td>
                                    <a class="btn btn-primary btn-xs edit" title="Edit" href="{{ route('mis.edit', $mis->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-xs delete" title="Delete" onclick="deleteRecord('{{ $mis->id }}')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="float-right">
                        {{ $misRecords->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add MIS Record Modal -->
<div class="modal fade" id="addMISView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addMISRecord" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="contact" class="col-form-label">Contact:</label>
                            <input type="text" class="form-control" id="contact" name="contact" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="office_contact" class="col-form-label">Office Contact:</label>
                            <input type="text" class="form-control" id="office_contact" name="office_contact" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="product_type" class="col-form-label">Product Type:</label>
                            <select class="form-control" id="product_type" name="product_type" required>
                                <option value="">Select Product Type</option>
                                <option value="Home Loan">Home Loan</option>
                                <option value="Personal Loan">Personal Loan</option>
                                <option value="MSME">MSME</option>
                                <option value="Vehicle Loan">Vehicle Loan</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="occupation" class="col-form-label">Occupation:</label>
                            <select class="form-control" id="occupation" name="occupation" required>
                                <option value="">Select Occupation</option>
                                <option value="Salaried" {{ old('occupation', $misRecord->occupation ?? '') == 'Salaried' ? 'selected' : '' }}>Salaried</option>
                                <option value="Self Employed" {{ old('occupation', $misRecord->occupation ?? '') == 'Self Employed' ? 'selected' : '' }}>Self Employed</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="bank_name" class="col-form-label">Bank Name:</label>
                            <select class="form-control" id="bank_name" name="bank_name" required>
                                <option value="">Select Bank Name</option>
                                <option value="IDFC" {{ old('bank_name', $misRecord->bank_name ?? '') == 'IDFC' ? 'selected' : '' }}>IDFC</option>
                                <option value="SBI" {{ old('bank_name', $misRecord->bank_name ?? '') == 'SBI' ? 'selected' : '' }}>SBI</option>
                                <option value="KOTAK" {{ old('bank_name', $misRecord->bank_name ?? '') == 'KOTAK' ? 'selected' : '' }}>KOTAK</option>
                                <option value="HDFC" {{ old('bank_name', $misRecord->bank_name ?? '') == 'HDFC' ? 'selected' : '' }}>HDFC</option>
                                <option value="MAHARASHTRA" {{ old('bank_name', $misRecord->bank_name ?? '') == 'MAHARASHTRA' ? 'selected' : '' }}>MAHARASHTRA</option>
                                <option value="AXIS" {{ old('bank_name', $misRecord->bank_name ?? '') == 'AXIS' ? 'selected' : '' }}>AXIS</option>
                                
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="branch_name" class="col-form-label">Branch Name:</label>
                            <input type="text" class="form-control" id="branch_name" name="branch_name" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="amount" class="col-form-label">Amount:</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="city" class="col-form-label">City:</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="address" class="col-form-label">Residencial Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="office_address" class="col-form-label">Office Address:</label>
                            <textarea class="form-control" id="office_address" name="office_address" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@parent

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function () {
    $('#misDataTable').DataTable();
});

function searchMIS() {
    let input = document.getElementById('search').value.toLowerCase();
    let rows = document.getElementById('mis_table_body').getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        let name = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
        rows[i].style.display = name.includes(input) ? "" : "none";
    }
}

$('#addMISRecord').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: "{{ route('mis.store') }}",
        method: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status === 'success') {
                swal("Success", data.message, "success").then(() => {
                    location.reload();
                });
            } else {
                swal("Error", data.message, "error");
            }
        }
    });
});

function deleteRecord(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, this record cannot be recovered!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "{{ route('mis.delete') }}",
                method: "POST",
                data: { _token: "{{ csrf_token() }}", id: id },
                success: function (data) {
                    swal("Deleted", data.message, "success").then(() => location.reload());
                },
                error: function () {
                    swal("Error", "Unable to delete the record. Try again later.", "error");
                }
            });
        }
    });
}

$('#exportExcel').on('click', function() {
    window.location.href = '{{ route('mis.exportExcel') }}';
});

$('#exportPDF').on('click', function() {
    window.location.href = '{{ route('mis.exportPDF') }}';
});
</script>

@endsection
