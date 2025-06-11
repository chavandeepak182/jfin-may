<?php

namespace App\Http\Controllers;

use App\Models\Mis;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MisExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\LoanBank;
use Illuminate\Support\Facades\DB;



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

        $query  = MIS::query()->latest();

        if ($request->filled(['from_date', 'to_date'])) {
            $query->whereBetween('created_at', [
                $request->input('from_date') . ' 00:00:00',
                $request->input('to_date') . ' 23:59:59'
            ]);
        }
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('contact', 'like', "%{$search}%");
            });
        }

        $banks = LoanBank::all();

        $misRecords = $query->paginate(10)->withQueryString();
        return view('mis.index', compact('misRecords', 'banks'));
    }


   public function store(Request $request)
    {
        // 1️⃣  Log the raw incoming payload.
        Log::info('MIS::store – incoming request', $request->all());

        try {
            // 2️⃣  Validate – will throw ValidationException on failure.
            $validatedData = $request->validate([
                'name'            => 'required|string|max:255',
                'email'           => 'required|email|max:255',
                'contact'         => 'required|string|max:255',
                'office_contact'  => 'nullable|string|max:255',
                'product_type'    => 'required|string|max:255',
                'bank_name'       => 'required|string|max:255',
                'occupation'      => 'required|string|max:255',
                'branch_name'     => 'required|string|max:255',
                'amount'          => 'required|numeric',
                'address'         => 'required|string',
                'city'            => 'required|string|max:255',
                'office_address'  => 'nullable|string|max:255',
            ]);

            Log::info('MIS::store – validation passed', $validatedData);

            // 3️⃣  Persist inside a transaction so both inserts succeed/fail together.
            DB::beginTransaction();

            // Insert into mis table.
            $misId = DB::table('mis')->insertGetId($validatedData);
            Log::info('MIS::store – inserted into mis table', ['id' => $misId]);

            // Insert into company_bank_details table.
            DB::table('company_bank_details')->insert([
                'bank_name'  => $validatedData['bank_name'],
                'id'     => $misId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Log::info('MIS::store – inserted into company_bank_details', ['id' => $misId]);

            DB::commit();

            // 4️⃣  Return success JSON.
            return response()->json([
                'status'  => 'success',
                'message' => 'Record added successfully!',
                'id'  => $misId,
            ], 201);

        } catch (ValidationException $e) {

            // 5️⃣  Log and return validation errors.
            Log::warning('MIS::store – validation failed', ['errors' => $e->errors()]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Validation errors occurred.',
                'errors'  => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {

            // 6️⃣  Roll back, log and return unexpected errors.
            DB::rollBack();

            Log::error('MIS::store – unexpected error', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong while saving the record.',
            ], 500);
        }
    }

    public function edit($id)
    {
        $misRecord = MIS::findOrFail($id);
        $banks = LoanBank::all();
        return view('mis.edit', compact('misRecord', 'banks'));
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
