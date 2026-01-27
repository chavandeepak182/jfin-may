<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketMessage;

class TicketMessageController extends Controller
{
    public function sendMessage(Request $request, $ticketId)
    {
        $request->validate([
            'message' => 'required'
        ]);

        $ticket = Ticket::findOrFail($ticketId);

        $this->authorizeTicket($ticket);

        TicketMessage::create([
            'ticket_id' => $ticket->id,
            'sender_id' => auth()->id(),
            'sender_role' => auth()->user()->role_id,
            'message' => $request->message
        ]);

        return back();
    }

    private function authorizeTicket(Ticket $ticket)
    {
        $user = auth()->user();

        if ($user->role_id == config('constants.roles.admin')) return;

        if ($user->role_id == config('constants.roles.agent') && $ticket->agent_id == $user->id) return;

        if ($ticket->user_id == $user->id) return;

        abort(403);
    }
}
