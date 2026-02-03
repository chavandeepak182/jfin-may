<div class="table-responsive">
    <table class="table">
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
        <tbody>
        @forelse($misRecords as $mis)
            <tr>
                <td>{{ $mis->id }}</td>
                <td>{{ $mis->name }}</td>
                <td>{{ $mis->email }}</td>
                <td>{{ $mis->contact }}</td>
                <td>{{ $mis->product_type }}</td>
                <td>{{ $mis->amount }}</td>
                <td>{{ $mis->city }}</td>
                <td class="d-flex gap-1">
                    <a href="{{ route('mis.edit', $mis->id) }}"
                       class="btn btn-sm btn-primary">Edit</a>

                    <button type="button"
                            class="btn btn-sm btn-danger"
                            onclick="deleteMIS({{ $mis->id }})">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted">
                    No records found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $misRecords->links('pagination::bootstrap-4') }}
</div>
