<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Referrer</th>
            <th>Referrer Mobile</th>
            <th>Referral Code</th>
            <th>Lead Name</th>
            <th>Lead Mobile</th>
            <th>Lead Email</th>
            <th>Product Type</th>
            <th>Status</th>
            <th>Action</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
    @forelse($referralLeads as $i => $lead)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $lead->referrer_name }}</td>
            <td>{{ $lead->referrer_mobile }}</td>
            <td>{{ $lead->referral_code }}</td>
            <td>{{ $lead->name }}</td>
            <td>{{ $lead->mobile }}</td>
            <td>{{ $lead->email ?? '-' }}</td>
            <td>
                <span class="badge bg-info">
                    {{ $lead->product_name ?? '-' }}
                </span>
            </td>
            <td>
                <span class="badge {{ $lead->status === 'pending' ? 'bg-warning' : 'bg-success' }}">
                    {{ ucfirst($lead->status) }}
                </span>
            </td>
            <td>
                @if($lead->status === 'pending')
                    <button class="btn btn-success btn-sm create-account-btn"
                            data-name="{{ $lead->name }}"
                            data-email="{{ $lead->email }}"
                            data-mobile="{{ $lead->mobile }}">
                        Create Account
                    </button>
                @else
                    <span class="text-muted">Created</span>
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('d M Y') }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="11" class="text-center text-muted">
                No referral leads found
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

{{ $referralLeads->links('pagination::bootstrap-4') }}
