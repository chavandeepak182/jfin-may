@extends('layouts.header')

@section('content')
@if(session('success'))
<script>
swal("Success", "{{ session('success') }}", "success");
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endif
<div class="container mt-4">

    <!-- HEADER ROW -->
    <div class="page-header-custom">

    <!-- LEFT TITLE -->
    <div>
        <h2>DSA Payout Config</h2>
    </div>

    <!-- RIGHT BUTTON -->
    <a href="{{ route('payout-configs.create') }}" class="btn-new">
        <i class="fas fa-user-plus"></i> Add Payout Config
    </a>

</div>

    <!-- CARD WRAPPER -->
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-hover mb-0 custom-table">
                <thead class="table-light">
                    <tr>
                        <th>Bank Name</th>
                        <th>Loan Category</th>
                        <th>Percentage (%)</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($configs as $config)
                        <tr>
                            <td>{{ $config->bank->bank_name ?? '-' }}</td>
                            <td>{{ $config->category->category_name ?? '-' }}</td>
                            <td>
                                <span class="badge bg-success">
                                    {{ $config->percentage }}%
                                </span>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('payout-configs.edit', $config->id) }}" 
                                   class="btn btn-sm btn-warning me-1">
                                   <i class="fas fa-edit"></i>
                                </a>

                                <form method="POST" 
                                      action="{{ route('payout-configs.destroy', $config->id) }}" 
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" 
                                            class="btn btn-sm btn-danger deleteBtn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <span class="text-muted">No payout config found</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
<script>
$(document).on('click', '.deleteBtn', function(){

    let form = $(this).closest('form');

    swal({
        title: "Are you sure?",
        text: "This record will be deleted permanently!",
        icon: "warning",
        buttons: ["Cancel", "Yes, Delete"],
        dangerMode: true,
    }).then((willDelete) => {

        if (willDelete) {
            form.submit();
        }

    });

});
</script>

<!-- ✅ CUSTOM CSS -->
<style>
/* Card look */
.card {
    border-radius: 10px;
    border: none;
}

/* Table styling */
.custom-table th {
    font-weight: 600;
    font-size: 14px;
}

.custom-table td {
    vertical-align: middle;
    font-size: 14px;
}

/* Hover effect */
.table-hover tbody tr:hover {
    background: #f8fafc;
}

/* Add button */
.add-btn {
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 500;
}
.page-header-custom {
    background: #f1f5f9;
    padding: 20px 25px;
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.page-header-custom h2 {
    margin: 0;
    font-weight: 600;
    color: #1e293b;
}

/* Blue Button */
.btn-new {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-new:hover {
    color: #fff;
    opacity: 0.9;
}

/* Action buttons spacing */
.btn-sm {
    padding: 5px 10px;
}
</style>

@endsection