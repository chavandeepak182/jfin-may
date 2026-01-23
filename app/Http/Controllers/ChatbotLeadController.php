<?php

namespace App\Http\Controllers;

use App\Models\ChatbotLead;
use Illuminate\Http\Request;

class ChatbotLeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:20',
        ]);

        $lead = ChatbotLead::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Lead saved successfully',
            'data' => $lead
        ]);
    }
}
