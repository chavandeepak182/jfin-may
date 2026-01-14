@extends($layout)

@section('content')

<style>
/* ===== Ticket UI Scoped Styles ===== */
.ticket-page {
    padding: 10px 5px;
}

.ticket-header-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
}

.ticket-title {
    font-size: 22px;
    font-weight: 600;
    color: #1f2937;
}

.ticket-create-btn {
    background: #2563eb;
    color: #fff;
    padding: 7px 14px;
    border-radius: 6px;
    font-size: 14px;
    text-decoration: none;
    transition: 0.2s;
}

.ticket-create-btn:hover {
    background: #1d4ed8;
    color: #fff;
}

.ticket-card-box {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    overflow: hidden;
}

.ticket-table-custom {
    width: 100%;
    border-collapse: collapse;
}

.ticket-table-custom thead {
    background: #f3f4f6;
}

.ticket-table-custom th,
.ticket-table-custom td {
    padding: 12px 14px;
    font-size: 14px;
    color: #374151;
    border-bottom: 1px solid #e5e7eb;
}

.ticket-table-custom tbody tr:hover {
    background: #f9fafb;
}

.ticket-status {
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 500;
    display: inline-block;
}

.ticket-status.open {
    background: #dcfce7;
    color: #166534;
}

.ticket-status.closed {
    background: #e5e7eb;
    color: #374151;
}

.ticket-status.in_progress {
    background: #fef3c7;
    color: #92400e;
}

.ticket-open-btn {
    padding: 6px 12px;
    border: 1px solid #2563eb;
    color: #2563eb;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    transition: 0.2s;
}

.ticket-open-btn:hover {
    background: #2563eb;
    color: #fff;
}

.ticket-empty-row {
    text-align: center;
    padding: 18px;
    color: #6b7280;
}
</style>

<div class="ticket-page">

    <div class="ticket-header-bar">
        <div class="ticket-title">Support Tickets</div>

        <a href="{{ route('tickets.create') }}" class="ticket-create-btn">
            + Create Ticket
        </a>
    </div>

    <div class="ticket-card-box">

        <table class="ticket-table-custom">

            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th width="110">Action</th>
                </tr>
            </thead>

            <tbody>
            @forelse($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->ticket_no }}</td>

                    <td>{{ $ticket->subject }}</td>

                    <td>
                        <span class="ticket-status {{ $ticket->status }}">
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('tickets.show',$ticket->id) }}" class="ticket-open-btn">
                            Open
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="ticket-empty-row">
                        No tickets found.
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection
