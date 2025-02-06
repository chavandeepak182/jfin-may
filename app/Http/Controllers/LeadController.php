<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;

class LeadController extends Controller {

    public function index() {
        // Check if the user is an admin (role_id = 4) from the session
        if (session('role_id') == 4) {
            // Admin sees all leads
            $leads = Lead::with('agent')->paginate(10);
        } elseif (session('role_id') == 2) {
            // Agent sees only assigned leads
            $userId = session('user_id'); // Assuming the user ID is stored in the session
            $leads = Lead::with('agent')->where('assigned_to', $userId)->paginate(10);
        } else {
            // If the user has neither admin nor agent role
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
        
        return view('leads.index', compact('leads'));
    }
    public function create() {
        // Check if the user has role_id 4 (admin) or 2 (agent)
        if (!in_array(session('role_id'), [4, 2])) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
    
        // Proceed if the user is either an admin or an agent
        $agents = User::where('role_id', 2)->get(); // Get agents for assignment
        return view('leads.create', compact('agents'));
    }

    public function store(Request $request) {
        // Check if the user has role_id 4 (admin) or 2 (agent)
        if (!in_array(session('role_id'), [4, 2])) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
    
        // If the user is an agent, automatically set the assigned_to field to the agent's ID
        if (session('role_id') == 2) {
            $request['assigned_to'] = session('user_id'); // Assuming the logged-in user's ID is stored in session as 'user_id'
        }
    
        // Validate the lead data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:leads',
            'phone' => 'required',
            'lead_source' => 'required',
            'property_type' => 'required',
            'budget_min' => 'required|numeric',
            'budget_max' => 'required|numeric',
            'location_preference' => 'required',
            'possession_time' => 'required',
            'property_status' => 'required',
            'lead_status' => 'required',
            'lead_score' => 'required|numeric',
            'assigned_to' => 'required|exists:users,id',
            'lead_type' => 'required',
            'financing_status' => 'required',
        ]);
    
        // Create the lead if valid
        Lead::create($request->all());
        return redirect()->route('leads.index')->with('success', 'Lead added successfully.');
    }

    public function show(Lead $lead) {
        return view('leads.show', compact('lead'));
    }

    public function edit(Lead $lead) {
        // Check if the user has role_id 4 (admin) or role_id 2 (agent)
        if (!in_array(session('role_id'), [4, 2])) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
    
        // If the user is an agent, ensure they can only edit leads assigned to them
        if (session('role_id') == 2 && $lead->assigned_to != session('user_id')) {
            return redirect('/home')->with('error', 'You do not have permission to edit this lead.');
        }
    
        // Get all agents (only for admin)
        $agents = User::where('role_id', 2)->get();
    
        return view('leads.edit', compact('lead', 'agents'));
    }

    public function update(Request $request, Lead $lead) {
        // Check if the user has role_id 4 (admin) or role_id 2 (agent)
        if (!in_array(session('role_id'), [4, 2])) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
    
        // If the user is an agent, ensure they can only update leads assigned to them
        if (session('role_id') == 2 && $lead->assigned_to != session('user_id')) {
            return redirect('/home')->with('error', 'You do not have permission to update this lead.');
        }
    
        // Validate the updated lead data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:leads,email,' . $lead->id,
            'phone' => 'required',
            'lead_source' => 'required',
            'property_type' => 'required',
            'budget_min' => 'required|numeric',
            'budget_max' => 'required|numeric',
            'location_preference' => 'required',
            'possession_time' => 'required',
            'property_status' => 'required',
            'lead_status' => 'required',
            'lead_score' => 'required|numeric',
            'assigned_to' => 'required|exists:users,id',
            'lead_type' => 'required',
            'financing_status' => 'required',
        ]);
    
        // Prevent agents from reassigning leads
        if (session('role_id') == 2) {
            $request['assigned_to'] = session('user_id'); // Keep the lead assigned to the same agent
        }
    
        // Update the lead
        $lead->update($request->all());
    
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }

    public function destroy(Lead $lead) {
        // Check if the user has role_id 4 (admin)
        if (session('role_id') != 4) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
    
        // Delete the lead if the user is an admin
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }
}

