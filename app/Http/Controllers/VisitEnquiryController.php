<?php

namespace App\Http\Controllers;

use App\Models\VisitEnquiry;
use App\Models\User;
use Illuminate\Http\Request;

class VisitEnquiryController extends Controller
{
    // ================= LIST LEADS (ADMIN + CP) =================
    public function index()
    {
        $adminRole   = config('constants.roles.admin');
        $partnerRole = config('constants.roles.partner');

        if (
            !auth()->check() ||
            !in_array(auth()->user()->role_id, [$adminRole, $partnerRole])
        ) {
            abort(403);
        }

        $leads = VisitEnquiry::orderBy('created_at', 'desc')->get();
        $propertyLeadsCount = $leads->count();

        // ✅ ONLY CP LIST (NOT AGENT)
        $partners = User::where('role_id', $partnerRole)->get();

        return view('bookvisit.leads', compact(
            'leads',
            'partners',
            'propertyLeadsCount'
        ));
    }

    // ================= STORE VISIT ENQUIRY =================
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
            'status'  => 'success',
            'message' => 'Visit enquiry submitted successfully'
        ]);
    }

    // ================= ASSIGN TO CP ONLY =================
    public function assign(Request $request)
    {
        $adminRole   = config('constants.roles.admin');
        $partnerRole = config('constants.roles.partner');

        // ✅ Only ADMIN can assign to CP
        if (auth()->user()->role_id != $adminRole) {
            abort(403);
        }

        $request->validate([
            'lead_id'    => 'required|exists:visit_enquiry,id',
            'partner_id' => 'required|exists:users,id',
        ]);

        // ✅ Ensure selected user is really CP
        User::where('id', $request->partner_id)
            ->where('role_id', $partnerRole)
            ->firstOrFail();

        VisitEnquiry::where('id', $request->lead_id)
            ->update(['assigned_to' => $request->partner_id]);

        return back()->with('success', 'Lead assigned to CP successfully');
    }

    // ================= CP CAN SEE ONLY OWN ASSIGNED LEADS =================
    public function partnerLeads()
    {
        if (auth()->user()->role_id != config('constants.roles.partner')) {
            abort(403);
        }

        $leads = VisitEnquiry::where('assigned_to', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        // NEW ✅ (reuse agent view)
return view('agent.bookvisit.assigned-leads', compact('leads'));
    }
    public function partnerPendingLeads()
{
    if (auth()->user()->role_id != config('constants.roles.partner')) {
        abort(403);
    }

    $leads = VisitEnquiry::where('assigned_to', auth()->id())
        ->where('status', 'pending')   // ✅ Filter added
        ->orderBy('created_at', 'desc')
        ->get();

    return view('agent.bookvisit.assigned-leads', compact('leads'));
}

}
