 <div class="card-body">
        <div class="table-responsive" id="loan_table">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Loan ID</th>
                        <th>User Name</th>
                        <th>Loan Category</th>
                        <th>Amount</th>
                         <th>Status</th>
                        <th>Tenure</th>
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                   @foreach($loans as $loan)
                    <tr>
                        <td>{{ $loan->loan_reference_id }}</td>
                        <td>{{ $loan->user_name }}</td>
                        <td>{{ $loan->category_name }}</td>
                        <td>{{ $loan->amount }}</td>
                        <td>{{ ucfirst($loan->status) }}</td>

                        <td>{{ $loan->tenure }}</td>
                        <td>
                            <a class="btn btn-primary btn-xs view" title="View" href="{{ route('loan.view', ['id' => $loan->loan_id]) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-primary btn-xs edit" title="Edit" href="{{ route('editLoan', ['id' => $loan->loan_id]) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-xs delete" title="Delete" onclick="deleteLoan('{{ $loan->loan_id }}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
              
            </table>
            <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3">
            {{ $loans->links('pagination::bootstrap-5') }}
        </div>
        </div>
    </div>

<script>
$(document).ready(function () {
    $('#example').DataTable();
});

function deleteLoan(id) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this loan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "{{ Route('deleteLoan') }}",
                type: 'post',
                dataType: 'json',
                data: {
                    'loan_id': id,
                    '_token': '{{ csrf_token() }}',
                },
                success: function (response) {
                    if (response.status == 0) {
                        swal("Deleted!", response.msg, "success").then(function() {
                            location.reload();
                        });
                    } else {
                        swal("Error!", response.msg, "error");
                    }
                }
            });
        }
    });
}
</script>
