@forelse($customers as $c)
<tr>
    <td>{{ $c->name }}</td>
    <td>{{ $c->mobile_no }}</td>
    <td>{{ $c->email }}</td>
    <td>{{ $c->dsa_name ?? '-' }}</td>
    <td>{{ $c->state_name ?? '-' }}</td>
    <td>{{ $c->city_name ?? '-' }}</td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center">
        No Customers Found
    </td>
</tr>
@endforelse