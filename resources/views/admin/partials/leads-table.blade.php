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
                    <!-- <td>{{ $lead->name }}</td> -->
                     <td>
        <a href="#" class="lead-name" data-bs-toggle="modal" data-bs-target="#leadModal{{ $lead->id }}">
            {{ $lead->name }}
        </a>

        <!-- Modal -->
        <div class="modal fade" id="leadModal{{ $lead->id }}" tabindex="-1" aria-labelledby="leadModalLabel{{ $lead->id }}" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="leadModalLabel{{ $lead->id }}">Lead Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Full Name</th>
                        <td>{{ $lead->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $lead->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $lead->phone }}</td>
                    </tr>
                    <tr>
                        <th>Lead Source</th>
                        <td>{{ $lead->lead_source }}</td>
                    </tr>
                    <tr>
                        <th>Interested In</th>
                        <td>{{ $lead->interested_in ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Budget</th>
                        <td>{{ $lead->budget ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Lead Status</th>
                        <td>{{ $lead->lead_status ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Assigned Employee</th>
                        <td>{{ $lead->agent->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Notes</th>
                        <td>{{ $lead->notes ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Follow Up Date</th>
                        <td>{{ \Carbon\Carbon::parse($lead->follow_up_date)->format('d M Y') }}</td>
                    </tr>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </td>
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
