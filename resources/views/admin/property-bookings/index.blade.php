@extends('layouts.header')

@section('content')
<style>
.title{
    color:#1565C0;
    padding-left:10px;  
    font-size:27px;
    margin-bottom:20px;
}
.prop-table{
    width:100%;
    margin:10px;
    border-radius:10px;
    border-collapse:seperate;
    border-spacing:0;
    /* overflow:hidden; */
    border: 1px solid #e2e8f0;
}
.prop-head{
    color:#1565C0;
}
.prop-cell{
    padding:10px;
}
.head-row{
    background-color:#f1f5f9;
    border-bottom:1px solid #e2e8f0;
}
.prop-row{
    border-bottom:1px solid #e2e8f0;
}
</style>
<h2 class="title">Property Bookings</h2>

<table class="prop-table">
    <thead class="prop-head">
        <tr class="head-row">
            <th class="prop-cell">ID</th>
            <th>Customer</th>
            <th>Property</th>
            <th>Status</th>
            <th>Action</th>
            <th>Assign Partner</th>
        </tr>
    </thead>

    <tbody>
    @forelse($bookings as $booking)
        <tr class="prop-row">
    <td class="prop-cell">#{{ $booking->id }}</td>

    <td>
        {{ optional($booking->customer)->name ?? 'N/A' }} <br>
        {{ optional($booking->customer)->mobile_no ?? 'N/A' }}
    </td>

    <td>
        @foreach($booking->items as $item)
            {{ $item->property->title ?? 'N/A' }}<br>
        @endforeach
    </td>

    <td>
        {{ ucwords(str_replace('_',' ',$booking->status)) }}
    </td>

    <td>
        <a href="{{ route('admin.property.booking.view', $booking->id) }}">
            View
        </a>

        @if(!in_array($booking->status, ['customer_confirmed','completed']))
            <a href="{{ route('admin.booking.edit', $booking->id) }}" style="margin-left:8px;">
                Edit
            </a>
        @endif

        @if($booking->status === 'customer_confirmed')
            <span style="color:green;">(Locked)</span>
        @endif
    </td>

    {{-- ✅ NEW COLUMN --}}
    <td>
        @if(!in_array($booking->status, ['customer_confirmed','completed']))
            
            <form method="POST" action="{{ route('admin.assign.partner', $booking->id) }}">
                @csrf

                <select name="partner_id" required>
                    <option value="">Select Partner</option>

                    @foreach(\App\Models\User::where('role_id', 3)->get() as $partner)
                        <option value="{{ $partner->id }}"
                            {{ $booking->partner_id == $partner->id ? 'selected' : '' }}>
                            {{ $partner->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit">Assign</button>
            </form>

        @else
            <span style="color:gray;">Locked</span>
        @endif
    </td>

</tr>
    @empty
        <tr>
            <td colspan="5">No bookings found</td>
        </tr>
    @endforelse
    </tbody>
</table>

@endsection
