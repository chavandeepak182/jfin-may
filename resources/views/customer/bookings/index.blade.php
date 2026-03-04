@extends('frontend.layouts.customer-dash')
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
.action-btns{
    display:inline-block;
    padding:6px ;
    background:#1565C0; 
    color:#fff; 
    border-radius:4px;
    text-decoration:none;
    transition: transform 0.2s ease;
}
.action-btns:hover{
    text-decoration:none;
    color:#fff;
    transform: scale(1.05);
    /* box-shadow: 0 8px 16px rgba(102, 126, 234, 0.3); */
}
</style>
@section('content')

<h2 class="title">My Property Bookings</h2>

<table class="prop-table">
    <thead class="prop-head">
        <tr  class="head-row">
            <th class="prop-cell">ID</th>
            <th>Property</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($bookings as $booking)
            <tr class="prop-row">
                <td class="prop-cell">#{{ $booking->id }}</td>

                <td>
                    @foreach($booking->items as $item)
                        {{ $item->property->title ?? 'N/A' }}<br>
                    @endforeach
                </td>

                <td>{{ ucwords(str_replace('_',' ',$booking->status)) }}</td>

               <td>

@if($booking->status === 'waiting_customer_confirmation')

<a href="{{ route('customer.booking.show.confirm',$booking->id) }}"
class="action-btns">
View & Confirm Offer
</a>

@elseif($booking->status === 'customer_confirmed')

<a href="{{ route('customer.booking.show.confirm',$booking->id) }}"
class="action-btns">
View Confirmation
</a>

@elseif($booking->status === 'completed')

<span style="color:green;font-weight:600;">
✔ Action Completed
</span>
<br>

<a href="{{ route('customer.booking.show.confirm',$booking->id) }}"
class="action-btns" style="margin-top:5px;">
View
</a>

@else

<span style="color:gray;">Pending Admin Review</span>

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
