<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyTaker;

class PropertyTakerController extends Controller
{
    public function create()
    {
        return view('property_takers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'builder_name' => 'required|string|max:255',
            'project_name' => 'required|string|max:255',
            'address' => 'required|string',
            'property_type' => 'required|string|max:255',
            'carpet_area' => 'required|numeric',
            'builtup_area' => 'required|numeric',
            'actual_agreement_cost' => 'required|numeric',
            'gst' => 'required|numeric',
            'extra_charges' => 'nullable|numeric',
            'stamp_duty' => 'required|numeric',
            'registration_fees' => 'required|numeric',
            'any_other_charges' => 'nullable|numeric',
            'total_charges' => 'required|numeric',
            'source_by' => 'required|string|max:255',
            'source_name' => 'nullable|string|max:255',
            'agreement_date' => 'required|date',
            'registration_number' => 'required|string|max:255',
        ]);

        PropertyTaker::create($request->all());

        return redirect()->back()->with('success', 'Property Taker record saved successfully.');
    }
}
