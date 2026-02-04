<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
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
            @forelse($leads as $index => $lead)
                <tr>
                    <td>{{ $leads->firstItem() + $index }}</td>
                    <td>{{ $lead->name }}</td>
                    <td>{{ $lead->email }}</td>
                    <td>{{ $lead->phone }}</td>
                    <td>{{ $lead->lead_source }}</td>
                    <td>{{ \Carbon\Carbon::parse($lead->follow_up_date)->format('d M Y') }}</td>
                    <td>{{ $lead->agent->name ?? 'N/A' }}</td>
                    <td class="d-flex gap-1">
                        <a class="btn btn-warning btn-xs" href="{{ route('leads.edit', $lead->id) }}">
                            <i class="fa fa-edit"></i>
                        </a>

                        <form action="{{ route('leads.destroy', $lead->id) }}"
                              method="POST"
                              class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        No leads found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $leads->links('pagination::bootstrap-4') }}
</div>
