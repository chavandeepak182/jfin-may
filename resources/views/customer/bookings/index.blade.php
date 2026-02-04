@extends('frontend.layouts.customer-dash')

@section('content')

<h3>My Property Bookings</h3>

<table border="1" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>ID</th>
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
                    @foreach($booking->items as $item)
                        {{ $item->property->title ?? 'N/A' }}<br>
                    @endforeach
                </td>

                <td>{{ ucwords(str_replace('_',' ',$booking->status)) }}</td>

                <td>
                    {{-- SHOW CONFIRM BUTTON ONLY WHEN OFFER EXISTS --}}
                    @if($booking->status === 'waiting_customer_confirmation')
                        <a href="{{ route('customer.booking.show.confirm',$booking->id) }}"
                           style="padding:6px 12px; background:#000; color:#fff; text-decoration:none;">
                            View & Confirm Offer
                        </a>

                    @elseif($booking->status === 'customer_confirmed')
                        <a href="{{ route('customer.booking.show.confirm',$booking->id) }}"
                           style="padding:6px 12px; background:#198754; color:#fff; text-decoration:none;">
                            View Confirmation
                        </a>

                    @else
                        <span style="color:gray;">Completed</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No bookings found</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
