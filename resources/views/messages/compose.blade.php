@extends('layouts.header')

@section('content')
<style>
    body, table{
        color: #fff !important;
    }
    </style>
<div class="container">
    <h1>Compose Message</h1>

    <form action="{{ route('messages.send') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="recipient_id">Recipient</label>
            <select name="recipient_id" id="recipient_id" class="form-control" required>
                <option value="">Select Recipient</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="message_body">Message</label>
            <textarea name="message_body" id="message_body" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Send</button>
    </form>
</div>
@endsection
