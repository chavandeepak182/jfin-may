@extends('layouts.header')

@section('content')

<style>
    body {
        background-color: #2c2f33;
        color: #fff !important;
        font-family: Arial, sans-serif;
    }
    .message-container {
        max-width: 700px;
        margin: 50px auto;
        background: #23272a;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    }
    .message-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
    }
    .message-header h2 {
        margin: 0;
        font-size: 22px;
    }
    .message-body {
        margin-top: 15px;
        font-size: 16px;
        line-height: 1.6;
    }
    .message-footer {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }
    .btn {
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }
    .btn-secondary {
        background-color: #7289da;
        color: white;
        border: none;
    }
    .btn-secondary:hover {
        background-color: #5b6eae;
    }
</style>

<div class="message-container">
    <div class="message-header">
        <h2>{{ $message->subject }}</h2>
        <small>{{ $message->created_at->format('Y-m-d H:i') }}</small>
    </div>
    
    <p><strong>From:</strong> {{ $message->sender->name }}</p>
    
    <div class="message-body">
        <p>{{ $message->message_body }}</p>
    </div>

    <div class="message-footer">
        <a href="{{ route('messages.index') }}" class="btn btn-secondary">Back to Inbox</a>
    </div>
</div>

@endsection
