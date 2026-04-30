@forelse($loans as $loan)
<tr>
    <td>{{ $loan->customer_name }}</td>
<td>{{ $loan->loan_ref ?? '-' }}</td>
    <td>{{ $loan->amount }}</td>
    <td>{{ ucfirst($loan->status) }}</td>
    <td>{{ date('d-m-Y', strtotime($loan->created_at)) }}</td>
</tr>
@empty
<tr>
    <td colspan="5">No Loans Found</td>
</tr>
@endforelse