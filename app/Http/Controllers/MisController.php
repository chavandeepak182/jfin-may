<?php

namespace App\Http\Controllers;
use App\Models\Mis;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MisExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;



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
    // public function index(Request $request)
    // {
    //     $misRecords = Mis::paginate(10);
    //     return view('mis.index', compact('misRecords'));
    // }


public function index(Request $request)
{
    $start_date = $request->start_date;
    $end_date = $request->end_date;

    // Validate and format the dates if provided
    if ($start_date && $end_date) {
        // Ensure dates are in a valid format
        $start_date = Carbon::parse($start_date)->startOfDay();
        $end_date = Carbon::parse($end_date)->endOfDay();

        $misRecords = Mis::whereBetween('created_at', [$start_date, $end_date])->paginate(10);
    } else {
        // No dates provided, return all records with pagination
        $misRecords = Mis::paginate(10);
    }

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
            'bm_name' => 'nullable|string|max:255',
            'login_date' => 'nullable|date',
            'status' => 'nullable|string|in:open,processing,closed', // adjust options as needed
            'in_principle' => 'nullable|in:yes,no',
            'remark' => 'nullable|string',
            'legal' => 'nullable|string',
            'valuation' => 'nullable|string',
            'leads' => 'nullable|string',
            'file_work' => 'nullable|string',
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
    // Log raw request data
    Log::info('MIS Update Request Data:', $request->all());

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

        // Additional fields
        'bm_name' => 'nullable|string|max:255',
        'login_date' => 'nullable|date',
        'status' => 'nullable|string|max:255',
        'in_principle' => 'nullable|string|max:255',
        'remark' => 'nullable|string',
        'legal' => 'nullable|string|max:255',
        'valuation' => 'nullable|string|max:255',
        'leads' => 'nullable|string|max:255',
        'file_work' => 'nullable|string|max:255',
    ]);

    // Log validated data
    Log::info('Validated Data for MIS Update:', $validatedData);

    $misRecord = MIS::findOrFail($id);

    // Log existing record before update
    Log::info('Original MIS Record:', $misRecord->toArray());

    $misRecord->update($validatedData);

    // Log updated record
    Log::info('Updated MIS Record:', $misRecord->fresh()->toArray());

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
