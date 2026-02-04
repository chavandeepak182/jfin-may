@extends('layouts.header')

@section('content')

<h2>Property Bookings</h2>

<table border="1" cellpadding="10" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Property</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
    @forelse($bookings as $booking)
        <tr>
            <td>#{{ $booking->id }}</td>

            <td>
                {{ $booking->customer->name }} <br>
                {{ $booking->customer->mobile_no }}
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
                {{-- Review / Final --}}
                <a href="{{ route('admin.property.booking.view', $booking->id) }}">
                    View
                </a>

                {{-- Quick badge --}}
                @if($booking->status === 'customer_confirmed')
                    <span style="color:green;">(Ready for Final)</span>
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
