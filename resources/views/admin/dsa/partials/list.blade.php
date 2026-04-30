@forelse($dsas as $key => $dsa)
<tr>
    <!-- ✅ SR NO -->
    <td>{{ $key + 1 }}</td>

    <!-- ✅ DSA CODE -->
    <td>{{ $dsa->dsa_code ?? '-' }}</td>

    <td>{{ $dsa->name }}</td>
    <td>{{ $dsa->email_id }}</td>
    <td>{{ $dsa->mobile_no }}</td>

    <!-- CITY -->
    <td>{{ $dsa->city_name ?? '-' }}</td>

    <!-- STATE -->
    <td>{{ $dsa->state_name ?? '-' }}</td>

    <!-- PAN -->
    <td>{{ $dsa->pan_no ?? '-' }}</td>

    <!-- ACTION -->
    <td>
        <button class="btn btn-sm btn-primary editBtn"
            data-id="{{ $dsa->id }}">
            <i class="fa fa-edit"></i>
        </button>
    </td>
</tr>

@empty
<tr>
    <td colspan="9" class="text-center">No DSA Found</td>
</tr>
@endforelse