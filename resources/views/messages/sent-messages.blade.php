@extends('layouts.header')

@section('title', 'Sent Messages')
@section('content')
<div class="container">
    <h1 class="my-4">Sent Messages</h1>

    @if ($messages->isEmpty())
        <div class="alert alert-info">
            You have not sent any messages yet.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Recipient Name</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Sent On</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $index => $message)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $message->recipient->name ?? 'N/A' }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ Str::limit($message->message_body, 50) }}</td>
                        <td>{{ $message->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
