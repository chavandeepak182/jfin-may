<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Loan;
use App\Models\User;
use App\Models\TicketMessage;

class TicketController extends Controller
{
    public function index()
{
    $user = auth()->user();

    $adminRole  = config('constants.roles.admin');
    $agentRole  = config('constants.roles.agent');
    $customerRole = config('constants.roles.customer');

    // Decide layout
    if ($user->role_id == $adminRole || $user->role_id == $agentRole) {
        $layout = 'layouts.header';
    } else {
        $layout = 'frontend.layouts.customer-dash';
    }

    if ($user->role_id == $adminRole) {
        $tickets = Ticket::latest()->paginate(10);
    }
    elseif ($user->role_id == $agentRole) {
        $tickets = Ticket::where('agent_id', $user->id)->latest()->paginate(10);
    }
    else {
        $tickets = Ticket::where('user_id', $user->id)->latest()->paginate(10);
    }

    return view('tickets.index', compact('tickets','layout'));
}



    public function create()
    {
        $user = auth()->user();

        // Decide layout based on role
        if ($user->role_id == config('constants.roles.admin') || $user->role_id == config('constants.roles.agent')) {
            $layout = 'layouts.header';
        } else {
            $layout = 'frontend.layouts.customer-dash';
        }

        // Admin data
        if ($user->role_id == config('constants.roles.admin')) {

            $users  = \App\Models\User::where('role_id', config('constants.roles.customer'))->get();
            $agents = \App\Models\User::where('role_id', config('constants.roles.agent'))->get();
            $loans  = \App\Models\Loan::all();

            return view('tickets.create', compact('users','agents','loans','layout'));
        }

        // Agent / Customer
        return view('tickets.create', compact('layout'));
    }


    public function store(Request $request)
    {
        $user = auth()->user();

        /* ================= VALIDATION ================= */

        if ($user->role_id == config('constants.roles.customer')) {
            $request->validate([
                'loan_id' => 'required|exists:loans,loan_id',
                'subject' => 'required',
                'message' => 'required'
            ]);
        }

        if ($user->role_id == config('constants.roles.agent')) {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'loan_id' => 'required|exists:loans,loan_id',
                'subject' => 'required',
                'message' => 'required'
            ]);
        }

        /* ================= ADMIN ================= */

        if ($user->role_id == config('constants.roles.admin')) {

            $agentId = $request->agent_id;

            if (!$agentId && $request->loan_id) {
                $loan = Loan::find($request->loan_id);
                $agentId = $loan?->agent_id;
            }

            $ticket = Ticket::create([
                'ticket_no' => 'TKT-'.time(),
                'user_id'   => $request->user_id,
                'loan_id'   => $request->loan_id,
                'agent_id'  => $agentId,
                'subject'   => $request->subject,
            ]);
        }

        /* ================= AGENT ================= */

        elseif ($user->role_id == config('constants.roles.agent')) {

            // Ensure this loan belongs to this agent
            $loan = Loan::where('loan_id', $request->loan_id)
                        ->where('agent_id', $user->id)
                        ->first();

            if (!$loan || $loan->user_id != $request->user_id) {
                abort(403, 'Unauthorized loan selection');
            }

            $ticket = Ticket::create([
                'ticket_no' => 'TKT-'.time(),
                'user_id'   => $request->user_id,
                'loan_id'   => $request->loan_id,
                'agent_id'  => $user->id,     // agent himself
                'subject'   => $request->subject
            ]);
        }

        /* ================= CUSTOMER ================= */

        else {

            $loan = Loan::find($request->loan_id);

            if (!$loan || $loan->user_id != $user->id) {
                abort(403, 'Unauthorized loan selection');
            }

            $ticket = Ticket::create([
                'ticket_no' => 'TKT-'.time(),
                'user_id'   => $user->id,
                'loan_id'   => $request->loan_id,
                'agent_id'  => $loan->agent_id,
                'subject'   => $request->subject
            ]);
        }

        /* ================= FIRST MESSAGE ================= */

        TicketMessage::create([
            'ticket_id'   => $ticket->id,
            'sender_id'   => $user->id,
            'sender_role' => $user->role_id,
            'message'     => $request->message
        ]);

        return redirect()->route('tickets.show', $ticket->id);
    }




    public function show($id)
    {
        $user = auth()->user();

        // Decide layout
        if ($user->role_id == config('constants.roles.admin') || $user->role_id == config('constants.roles.agent')) {
            $layout = 'layouts.header';
        } else {
            $layout = 'frontend.layouts.customer-dash';
        }

        $ticket = Ticket::with('messages.sender')->findOrFail($id);

        $this->authorizeTicket($ticket);

        return view('tickets.show', compact('ticket','layout'));
    }


    private function authorizeTicket(Ticket $ticket)
    {
        $user = auth()->user();

        if ($user->role_id == config('constants.roles.admin')) return;

        if ($user->role_id == config('constants.roles.agent') && $ticket->agent_id == $user->id) return;

        if ($ticket->user_id == $user->id) return;

        abort(403,'Unauthorized Ticket Access');
    }

    public function update(Request $request,$id)
    {
        $ticket = Ticket::findOrFail($id);

        if(auth()->user()->role_id != config('constants.roles.admin')){
            abort(403);
        }

        $ticket->update([
            'status'=>$request->status,
            'agent_id'=>$request->agent_id
        ]);

        return back();
    }
    public function getUserLoans($userId)
    {
        return Loan::where('user_id',$userId)
            ->select('loan_id','loan_reference_id')
            ->get();
    }

    public function getLoanAgent($loanId)
    {
        return Loan::where('loan_id', $loanId)
            ->whereNotNull('agent_id')
            ->join('users', 'users.id', '=', 'loans.agent_id')
            ->where('users.role_id', config('constants.roles.agent'))
            ->select('users.id', 'users.name')
            ->first() 
            ? response()->json([
                'agent' => Loan::where('loan_id', $loanId)
                    ->join('users', 'users.id', '=', 'loans.agent_id')
                    ->where('users.role_id', config('constants.roles.agent'))
                    ->select('users.id','users.name')
                    ->first()
            ])
            : response()->json(['agent'=>null]);
    }
    public function close($id)
    {
        $ticket = Ticket::findOrFail($id);

        // Authorization
        $user = auth()->user();

        if (
            $user->role_id == config('constants.roles.admin') ||
            ($user->role_id == config('constants.roles.agent') && $ticket->agent_id == $user->id) ||
            ($ticket->user_id == $user->id)
        ) {
            $ticket->update(['status' => 'closed']);
            return back()->with('success', 'Ticket closed successfully.');
        }

        abort(403, 'Unauthorized');
    }
    public function agentCustomers()
    {
        return Loan::where('agent_id', auth()->id())
            ->join('users','users.id','=','loans.user_id')
            ->select('users.id','users.name')
            ->distinct()
            ->get();
    }

    public function agentUserLoans($userId)
    {
        return Loan::where('agent_id', auth()->id())
            ->where('user_id',$userId)
            ->select('loan_id','loan_reference_id')
            ->get();
    }

}
