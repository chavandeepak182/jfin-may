@extends($layout)
@section('title', 'Sent Messages')
@section('content')
<style type="text/css">body{
    margin-top:20px;
    background:#eee;
    }
    /* EMAIL */
    .email {
        padding: 20px 10px 15px 10px;
        font-size: 1em;
    }

    .email .btn.search {
        font-size: 0.9em;
    }

    .email h2 {
        margin-top: 0;
        padding-bottom: 8px;
    }

    .email .nav.nav-pills > li > a {
        border-top: 3px solid transparent;
    }

    .email .nav.nav-pills > li > a > .fa {
        margin-right: 5px;
    }

    .email .nav.nav-pills > li.active > a,
    .email .nav.nav-pills > li.active > a:hover {
        background-color: #f6f6f6;
        border-top-color: #3c8dbc;
    }

    .email .nav.nav-pills > li.active > a {
        font-weight: 600;
    }

    .email .nav.nav-pills > li > a:hover {
        background-color: #f6f6f6;
    }

    .email .nav.nav-pills.nav-stacked > li > a {
        color: #666;
        border-top: 0;
        border-left: 3px solid transparent;
        border-radius: 0px;
    }

    .email .nav.nav-pills.nav-stacked > li.active > a,
    .email .nav.nav-pills.nav-stacked > li.active > a:hover {
        background-color: #f6f6f6;
        border-left-color: #3c8dbc;
        color: #444;
    }

    .email .nav.nav-pills.nav-stacked > li.header {
        color: #777;
        text-transform: uppercase;
        position: relative;
        padding: 0px 0 10px 0;
    }

    .email table {
        font-weight: 600;
    }

    .email table a {
        color: #666;
    }

    .email table tr.read > td {
        background-color: #f6f6f6;
    }

    .email table tr.read > td {
        font-weight: 400;
    }

    .email table tr td > i.fa {
        font-size: 1.2em;
        line-height: 1.5em;
        text-align: center;
    }

    .email table tr td > i.fa-star {
        color: #f39c12;
    }

    .email table tr td > i.fa-bookmark {
        color: #e74c3c;
    }

    .email table tr > td.action {
        padding-left: 0px;
        padding-right: 2px;
    }

    .grid {
        position: relative;
        width: 100%;
        background: #fff;
        color: #666666;
        border-radius: 2px;
        margin-bottom: 25px;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
    }



    .grid .grid-header:after {
        clear: both;
    }

    .grid .grid-header span,
    .grid .grid-header > .fa {
        display: inline-block;
        margin: 0;
        font-weight: 300;
        font-size: 1.5em;
        float: left;
    }

    .grid .grid-header span {
        padding: 0 5px;
    }

    .grid .grid-header > .fa {
        padding: 5px 10px 0 0;
    }

    .grid .grid-header > .grid-tools {
        padding: 4px 10px;
    }

    .grid .grid-header > .grid-tools a {
        color: #999999;
        padding-left: 10px;
        cursor: pointer;
    }

    .grid .grid-header > .grid-tools a:hover {
        color: #666666;
    }

    .grid .grid-body {
        padding: 15px 20px 15px 20px;
        font-size: 0.9em;
        line-height: 1.9em;
    }

    .grid .full {
        padding: 0 !important;
    }

    .grid .transparent {
        box-shadow: none !important;
        margin: 0px !important;
        border-radius: 0px !important;
    }

    .grid.top.black > .grid-header {
        border-top-color: #000000 !important;
    }

    .grid.bottom.black > .grid-body {
        border-bottom-color: #000000 !important;
    }

    .grid.top.blue > .grid-header {
        border-top-color: #007be9 !important;
    }

    .grid.bottom.blue > .grid-body {
        border-bottom-color: #007be9 !important;
    }

    .grid.top.green > .grid-header {
        border-top-color: #00c273 !important;
    }

    .grid.bottom.green > .grid-body {
        border-bottom-color: #00c273 !important;
    }

    .grid.top.purple > .grid-header {
        border-top-color: #a700d3 !important;
    }

    .grid.bottom.purple > .grid-body {
        border-bottom-color: #a700d3 !important;
    }

    .grid.top.red > .grid-header {
        border-top-color: #dc1200 !important;
    }

    .grid.bottom.red > .grid-body {
        border-bottom-color: #dc1200 !important;
    }

    .grid.top.orange > .grid-header {
        border-top-color: #f46100 !important;
    }

    .grid.bottom.orange > .grid-body {
        border-bottom-color: #f46100 !important;
    }

    .grid.no-border > .grid-header {
        border-bottom: 0px !important;
    }

    .grid.top > .grid-header {
        border-top-width: 4px !important;
        border-top-style: solid !important;
    }

    .grid.bottom > .grid-body {
        border-bottom-width: 4px !important;
        border-bottom-style: solid !important;
    }
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="grid email">
                <div class="grid-body">
                    <div class="row">
                        <!-- Sidebar -->
                        <div class="col-md-3">
                            <h2 class="grid-title"><i class="fa fa-inbox"></i> Inbox</h2>
                            <a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal">
                                <i class="fa fa-pencil"></i>&nbsp;&nbsp;NEW MESSAGE
                            </a>
                            <hr>
                            <ul class="nav-pills nav-stacked">
                                <li class="{{ request()->routeIs('messages.index') ? 'active' : '' }}">
                                    <a href="{{ route('messages.index') }}"><i class="fa fa-inbox"></i> Inbox</a>
                                </li>
                                <li class="{{ request()->routeIs('messages.sent') ? 'active' : '' }}">
                                    <a href="{{ route('messages.sent') }}"><i class="fa fa-paper-plane"></i> Sent</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Messages List -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6 search-form">
                                    <form action="{{ route('messages.index') }}" method="GET" class="mb-3">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" placeholder="Search messages..." value="{{ request('search') }}">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-search"></i> Search
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Message List -->
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        @forelse($messages as $message)
                                            <tr onclick="window.location.href='{{ route('messages.show', $message->id) }}'">
                                                <td class="action"><i class="fa fa-bookmark-o"></i></td>
                                                <td class="name">
                                                    <a href="{{ route('messages.show', $message->id) }}">
                                                        {{ $message->sender->name }}
                                                    </a>
                                                </td>
                                                <td class="subject">
                                                    <a href="{{ route('messages.show', $message->id) }}">
                                                        {{ Str::limit($message->message_body, 50) }}
                                                    </a>
                                                </td>
                                                <td class="time">{{ $message->created_at->format('h:i A') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No messages found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>                        
                        </div> <!-- End Messages List -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Compose Message Modal -->
<div id="compose-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @php
                $users = DB::table('users')->select('id', 'name')->get();
            @endphp
            <form action="{{ route('messages.send') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient_id">Recipient</label>
                        <select name="recipient_id" id="recipient_id" class="form-control" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Send</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>

    <script>
        $('#compose-modal').modal('hide');
    </script>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
@endsection
