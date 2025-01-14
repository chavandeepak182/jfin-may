<?php

namespace App\Http\Controllers;
use App\Models\Mis;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MisExport;


use Illuminate\Http\Request;

class MisController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new MisExport, 'mis_records.xlsx');
    }
    public function exportPDF()
    {
        $misRecords = MIS::all();
        $pdf = PDF::loadView('mis.export_pdf', compact('misRecords'));
        return $pdf->download('mis_records.pdf');
    }
    public function index()
    {
        $misRecords = Mis::paginate(10);
        return view('mis.index', compact('misRecords'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:255',
            'office_contact' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'branch_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'office_address' =>'nullable|string|max:255',
        ]);
    
        MIS::create($validatedData);
    
        return response()->json(['status' => 'success', 'message' => 'Record added successfully!']);
    }
    public function edit($id)
    {
        $misRecord = MIS::findOrFail($id); // Find the record by ID or fail if not found
    
        // Return the edit view with the record data
        return view('mis.edit', compact('misRecord'));
    }
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'contact' => 'required|string|max:255',
        'office_contact' => 'required|string|max:255',
        'product_type' => 'required|string|max:255',
        'bank_name' => 'required|string|max:255',
        'occupation' => 'required|string|max:255',
        'branch_name' => 'required|string|max:255',
        'amount' => 'required|numeric',
        'address' => 'required|string',
        'office_address' => 'nullable|string|max:255',
        'city' => 'required|string|max:255',
    ]);

    $misRecord = MIS::findOrFail($id);
    $misRecord->update($validatedData);

    return redirect()->route('mis.index')->with('success', 'Record updated successfully');
}
    public function destroy(Request $request)
    {
        $mis = Mis::find($request->id);
        if ($mis) {
            $mis->delete();
            return response()->json(['status' => 'success', 'message' => 'Record deleted successfully!']);
        }
        return response()->json(['status' => 'error', 'message' => 'Record not found!']);
    }
}
