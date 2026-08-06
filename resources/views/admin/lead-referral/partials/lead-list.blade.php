@if($leadReferrals->count() > 0)

    @foreach($leadReferrals as $key => $row)

    <tr>

        <td>{{ $key + 1 }}</td>

        <td>{{ $row->customer_name }}</td>

        <td>{{ $row->mobile_no }}</td>

        <td>{{ $row->email }}</td>

        <td>{{ $row->loan_type ?? '-' }}</td>

        <td>₹ {{ number_format($row->loan_amount) }}</td>

        <td>
            @if($row->status == 'Closed')
                <span class="badge bg-success">Closed</span>
            @elseif($row->status == 'New')
                <span class="badge bg-primary">New</span>
            @elseif($row->status == 'Pending')
                <span class="badge bg-warning">Pending</span>
            @else
                <span class="badge bg-secondary">{{ $row->status }}</span>
            @endif
        </td>

        <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</td>

       

    </tr>

    @endforeach

@else

<tr>
    <td colspan="9" class="text-center text-danger">
        No Lead Found
    </td>
</tr>

@endif