<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyTaker;
use App\Models\User;

class PropertyTakerController extends Controller
{
    public function index()
    {
        $propertyTakers = PropertyTaker::paginate(10);
        return view('property_takers.index', compact('propertyTakers'));
    }

    public function create()
    {
        $agents = User::where('role_id', 2)->get(['id', 'name']); // Agents only
        return view('property_takers.create', compact('agents'));
    }

    public function show($id)
    {
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
            'stamp_duty_percentage' => 'required|numeric', // ✅ Stamp Duty %
            'registration_fees' => 'required|numeric',
            'any_other_charges' => 'nullable|numeric',
            'source_by' => 'required|string|max:255',
            'source_name_agent' => 'nullable|string|max:255',
            'source_name_builder' => 'nullable|string|max:255',
            'agreement_date' => 'required|date',
            'registration_number' => 'required|string|max:255',
        ]);

        // Calculations
        $actualAgreementCost = $request->actual_agreement_cost;
        $gstPercentage = $request->gst;
        $gstAmount = ($actualAgreementCost * $gstPercentage) / 100;
        $afterGstAgreementCost = $actualAgreementCost + $gstAmount;

        $stampDutyPercentage = $request->stamp_duty_percentage;
        $stampDutyAmount = ($actualAgreementCost * $stampDutyPercentage) / 100;

        $totalCharges = $afterGstAgreementCost +
                        $stampDutyAmount +
                        $request->registration_fees +
                        ($request->extra_charges ?? 0) +
                        ($request->any_other_charges ?? 0);

        $sourceName = ($request->source_by == 'Agent') ? $request->source_name_agent : $request->source_name_builder;

        // Save
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
            'stamp_duty_percentage' => $stampDutyPercentage, // ✅ Save %
            'stamp_duty' => $stampDutyAmount,                // ✅ Save amount
            'registration_fees' => $request->registration_fees,
            'any_other_charges' => $request->any_other_charges,
            'total_charges' => $totalCharges,
            'source_by' => $request->source_by,
            'source_name' => $sourceName,
            'agreement_date' => $request->agreement_date,
            'registration_number' => $request->registration_number,
        ]);
        return redirect()
    ->route('allProperties')
    ->with('success', 'Property Taker record saved successfully.');

    }

    public function edit($id)
    {
        $propertyTaker = PropertyTaker::findOrFail($id);
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
            'stamp_duty_percentage' => 'required|numeric', // ✅ Stamp Duty %
            'registration_fees' => 'required|numeric',
            'any_other_charges' => 'nullable|numeric',
            'source_by' => 'required|string|max:255',
            'source_name' => 'nullable|string|max:255',
            'agreement_date' => 'required|date',
            'registration_number' => 'required|string|max:255',
        ]);

        $propertyTaker = PropertyTaker::findOrFail($id);

        // Calculations
        $actualAgreementCost = $request->actual_agreement_cost;
        $gstPercentage = $request->gst;
        $gstAmount = ($actualAgreementCost * $gstPercentage) / 100;
        $afterGstAgreementCost = $actualAgreementCost + $gstAmount;

        $stampDutyPercentage = $request->stamp_duty_percentage;
        $stampDutyAmount = ($actualAgreementCost * $stampDutyPercentage) / 100;

        $totalCharges = $afterGstAgreementCost +
                        $stampDutyAmount +
                        $request->registration_fees +
                        ($request->extra_charges ?? 0) +
                        ($request->any_other_charges ?? 0);

        // Update
        $propertyTaker->update([
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
            'stamp_duty_percentage' => $stampDutyPercentage, // ✅ Save %
            'stamp_duty' => $stampDutyAmount,                // ✅ Save amount
            'registration_fees' => $request->registration_fees,
            'any_other_charges' => $request->any_other_charges,
            'total_charges' => $totalCharges,
            'source_by' => $request->source_by,
            'source_name' => $request->source_name,
            'agreement_date' => $request->agreement_date,
            'registration_number' => $request->registration_number,
        ]);

        return redirect()->route('allProperties')->with('success', 'Property Taker record updated successfully.');
    }

    public function destroy($id)
    {
        $taker = PropertyTaker::findOrFail($id);
        $taker->delete();

        return redirect()->route('property_takers.index')
                         ->with('success', 'Property Taker deleted successfully.');
    }
}
