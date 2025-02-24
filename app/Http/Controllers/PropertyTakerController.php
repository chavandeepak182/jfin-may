<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyTaker;
use App\Models\User;

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
        $agents = User::where('role_id', 2)->get(['id', 'name']); // Fetch users with role_id = 2 (Agents)
        return view('property_takers.create', compact('agents'));
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
            'stamp_duty_percentage' => 'required|numeric', // Stamp Duty Percentage
            'registration_fees' => 'required|numeric',
            'any_other_charges' => 'nullable|numeric',
            'source_by' => 'required|string|max:255',
            'source_name_agent' => 'nullable|string|max:255',
            'source_name_builder' => 'nullable|string|max:255',
            'agreement_date' => 'required|date',
            'registration_number' => 'required|string|max:255',
        ]);
    
        // Calculate After GST Agreement Cost
        $actualAgreementCost = $request->actual_agreement_cost;
        $gstPercentage = $request->gst;
        $gstAmount = ($actualAgreementCost * $gstPercentage) / 100;
        $afterGstAgreementCost = $actualAgreementCost + $gstAmount;
    
        // Calculate Stamp Duty Amount
        $stampDutyPercentage = $request->stamp_duty_percentage;
        $stampDutyAmount = ($actualAgreementCost * $stampDutyPercentage) / 100;
    
        // Calculate Total Charges
        $totalCharges = $afterGstAgreementCost + 
                        $stampDutyAmount + 
                        $request->registration_fees + 
                        ($request->extra_charges ?? 0) + 
                        ($request->any_other_charges ?? 0);
                        $sourceName = ($request->source_by == 'Agent') ? $request->source_name_agent : $request->source_name_builder;


        // Save to database
        PropertyTaker::create([
            'builder_name' => $request->builder_name,
            'project_name' => $request->project_name,
            'address' => $request->address,
            'property_type' => $request->property_type,
            'carpet_area' => $request->carpet_area,
            'builtup_area' => $request->builtup_area,
            'actual_agreement_cost' => $actualAgreementCost,
            'gst' => $gstPercentage,
            'after_gst_agreement_cost' => $afterGstAgreementCost,
            'extra_charges' => $request->extra_charges,
            'stamp_duty' => $stampDutyAmount, // Save calculated Stamp Duty
            'registration_fees' => $request->registration_fees,
            'any_other_charges' => $request->any_other_charges,
            'total_charges' => $totalCharges, // Save updated Total Charges
            'source_by' => $request->source_by,
            'source_name' => $sourceName,
            'agreement_date' => $request->agreement_date,
            'registration_number' => $request->registration_number,
        ]);
    
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
            'stamp_duty_percentage' => 'required|numeric', // Stamp Duty Percentage
            'registration_fees' => 'required|numeric',
            'any_other_charges' => 'nullable|numeric',
            'source_by' => 'required|string|max:255',
            'source_name' => 'nullable|string|max:255',
            'agreement_date' => 'required|date',
            'registration_number' => 'required|string|max:255',
        ]);
    
        // Find the property taker by ID
        $propertyTaker = PropertyTaker::findOrFail($id);
    
        // Calculate After GST Agreement Cost
        $actualAgreementCost = $request->actual_agreement_cost;
        $gstPercentage = $request->gst;
        $gstAmount = ($actualAgreementCost * $gstPercentage) / 100;
        $afterGstAgreementCost = $actualAgreementCost + $gstAmount;
    
        // Calculate Stamp Duty Amount
        $stampDutyPercentage = $request->stamp_duty_percentage;
        $stampDutyAmount = ($actualAgreementCost * $stampDutyPercentage) / 100;
    
        // Calculate Total Charges
        $totalCharges = $afterGstAgreementCost + 
                        $stampDutyAmount + 
                        $request->registration_fees + 
                        ($request->extra_charges ?? 0) + 
                        ($request->any_other_charges ?? 0);
    
        // Update the record
        $propertyTaker->update([
            'builder_name' => $request->builder_name,
            'project_name' => $request->project_name,
            'address' => $request->address,
            'property_type' => $request->property_type,
            'carpet_area' => $request->carpet_area,
            'builtup_area' => $request->builtup_area,
            'actual_agreement_cost' => $actualAgreementCost,
            'gst' => $gstPercentage,
            'after_gst_agreement_cost' => $afterGstAgreementCost, // Save recalculated GST amount
            'extra_charges' => $request->extra_charges,
            'stamp_duty' => $stampDutyAmount, // Save recalculated Stamp Duty
            'registration_fees' => $request->registration_fees,
            'any_other_charges' => $request->any_other_charges,
            'total_charges' => $totalCharges, // Save recalculated Total Charges
            'source_by' => $request->source_by,
            'source_name' => $request->source_name,
            'agreement_date' => $request->agreement_date,
            'registration_number' => $request->registration_number,
        ]);
    
        // Redirect back with success message
        return redirect()->route('property_takers.index')->with('success', 'Property Taker record updated successfully.');
    }
    

}
