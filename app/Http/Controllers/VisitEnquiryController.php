<?php
namespace App\Http\Controllers;

use App\Models\VisitEnquiry;
use APp\Models\User;
use Illuminate\Http\Request;

class VisitEnquiryController extends Controller
{
   public function index()
    {
        $adminRole = config('constants.roles.admin');
        $agentRole = config('constants.roles.agent');

        if (auth()->user()->role_id != $adminRole) {
            abort(403);
        }

        $leads = VisitEnquiry::with('agent')
            ->orderBy('created_at', 'desc')
            ->get();

        $agents = User::where('role_id', $agentRole)->get();

        return view('bookvisit.leads', compact('leads', 'agents'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required',
            'email'      => 'nullable|email',
            'phone'      => 'required',
            'visitedate' => 'required|in:this week,this weekend,this month'
        ]);

        VisitEnquiry::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Visit enquiry submitted successfully'
        ]);
    }
    public function assign(Request $request)
    {
        $request->validate([
            'lead_id'  => 'required|exists:visit_enquiry,id',
            'agent_id' => 'required|exists:users,id',
        ]);

        VisitEnquiry::where('id', $request->lead_id)
            ->update(['assigned_to' => $request->agent_id]);

        return back()->with('success', 'Lead assigned successfully');
    }
    public function agentLeads()
    {
        $agentRole = config('constants.roles.agent');

        if (auth()->user()->role_id != $agentRole) {
            abort(403);
        }

        $leads = VisitEnquiry::where('assigned_to', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('agent.bookvisit.assigned-leads', compact('leads'));
    }
}
