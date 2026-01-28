@extends($layout)
@section('content')
@if($ticket->status != 'closed')
    <form method="POST" action="{{ route('tickets.close', $ticket->id) }}"
          onsubmit="return confirm('Are you sure you want to close this ticket?')">
        @csrf
        <button type="submit" style="background:red;color:white;padding:6px 12px;border:none;">
            Close Ticket
        </button>
    </form>
@else
    <span style="color:green;font-weight:bold;">Ticket Closed</span>
@endif
<h2 class="text-dark">Ticket: {{ $ticket->ticket_no }}</h2>
<p>{{ $ticket->subject }}</p>

<hr>

<div style="border:1px solid #ccc;padding:10px;height:300px;overflow-y:scroll">

@foreach($ticket->messages as $msg)
<div style="margin-bottom:10px">
<b>{{ $msg->sender->name }}</b> :
{{ $msg->message }}
<br>
<small>{{ $msg->created_at }}</small>
</div>
@endforeach

</div>

<hr>

<form method="POST" action="{{ route('tickets.message',$ticket->id) }}">
@csrf
<textarea name="message" rows="3" style="width:100%" required></textarea>
<br>
<button type="submit">Send</button>
</form>
@endsection