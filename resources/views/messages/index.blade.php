@extends('layouts.header')
@section('content')
<style>
    body, table{
        color: #fff !important;
    }
    </style>
<div class="container">
    <h1>Inbox</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>From</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($messages as $message)
                <tr class="{{ $message->is_read ? '' : 'table-info' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $message->sender->name }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('messages.show', $message->id) }}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No messages found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
