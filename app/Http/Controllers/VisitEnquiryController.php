<?php
namespace App\Http\Controllers;

use App\Models\VisitEnquiry;
use Illuminate\Http\Request;

class VisitEnquiryController extends Controller
{
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
}
