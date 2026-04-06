@forelse($dsas as $dsa)
<tr>
    <td>{{ $dsa->id }}</td>
    <td>{{ $dsa->name }}</td>
    <td>{{ $dsa->email_id }}</td>
    <td>{{ $dsa->mobile_no }}</td>
    <td>{{ $dsa->city ?? '-' }}</td>
    <td>{{ $dsa->state ?? '-' }}</td>
    <td>{{ $dsa->pincode ?? '-' }}</td>
</tr>
@empty
<tr>
    <td colspan="7" class="text-center">No DSA Found</td>
</tr>
@endforelse