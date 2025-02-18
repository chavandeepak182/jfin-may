<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyTaker;

class PropertyTakerController extends Controller
{
    public function index()
    {
        // Paginate the property takers, for example, 10 items per page
        $propertyTakers = PropertyTaker::paginate(10);
    
        return view('property_takers.index', compact('propertyTakers'));
    }
    public function create()
    {
        return view('property_takers.create');
    }
    public function show($id)
    {
        // Fetch property taker details by ID
        $propertyTaker = PropertyTaker::findOrFail($id);
    
        return view('property_takers.view', compact('propertyTaker'));
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
    public function edit($id)
    {
        // Find the property taker by ID
        $propertyTaker = PropertyTaker::findOrFail($id);

        // Return the 'edit' view and pass the property taker data
        return view('property_takers.edit', compact('propertyTaker'));
    }
    public function update(Request $request, $id)
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

        // Find the property taker by ID and update the record
        $propertyTaker = PropertyTaker::findOrFail($id);
        $propertyTaker->update($request->all());

        // Redirect back with success message
        return redirect()->route('property_takers.index')->with('success', 'Property Taker record updated successfully.');
    }
}
