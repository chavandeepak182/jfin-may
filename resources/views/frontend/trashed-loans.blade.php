@extends('layouts.header')

@section('title')
    @parent
    Trashed Loans
@endsection

@section('content')
<style>
    #wrapper #content-wrapper #content{

        background-color: #f8f9fc;
        
    }
    
</style>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Trashed Loans</h6>
           
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="trashedLoansTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Loan No.</th>
                        <th>Name</th>
                        <th>Product Type</th>
                        <th>Amount</th>
                        <th>Bank</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $loan)
                        <tr>
                            <td>{{ $loop->iteration + ($loans->currentPage() - 1) * $loans->perPage() }}</td>
                            <td>{{ $loan['loan_reference_id'] }}</td>
                            <td>{{ $loan['user_name'] }}</td>
                            <td>{{ $loan['loan_category_name'] }}</td>
                            <td>{{ $loan['amount'] }}</td>
                            <td>{{ $loan['bank_name'] }}</td>
                            <td>{{ $loan['city'] }}</td>
                            <td>
                                <button class="btn btn-warning btn-xs" onclick="restoreLoan('{{ $loan['loan_id'] }}')">
                                    <i class="fa fa-undo"></i> Restore
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="dataTables_info">
                    Showing {{ $loans->firstItem() }} to {{ $loans->lastItem() }} of {{ $loans->total() }} entries
                </div>
                <div class="dataTables_paginate paging_simple_numbers">
                    {{ $loans->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function restoreLoan(loanId) {
        Swal.fire({
            title: 'Restore this loan?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, restore it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('restoreLoan') }}",
                    method: "POST",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'loan_id': loanId
                    },
                    success: function (response) {
                        Swal.fire('Restored!', response.message, 'success')
                            .then(() => location.reload());
                    },
                    error: function () {
                        Swal.fire('Error', 'Unable to restore the loan.', 'error');
                    }
                });
            }
        });
    }
</script>
@endsection
