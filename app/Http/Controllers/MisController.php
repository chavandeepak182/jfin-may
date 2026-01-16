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
        $misRecords = Mis::all();
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
    $roleId = session()->get('role_id');
    $userId = session()->get('user_id');

    $query = MIS::query()->latest();

    // 🔐 Agent restriction
    if ($roleId == env('agentRole_id')) {
        $query->where('created_by', $userId);
    }

    // Date filter
    if ($request->filled(['from_date', 'to_date'])) {
        $query->whereBetween('created_at', [
            $request->from_date . ' 00:00:00',
            $request->to_date . ' 23:59:59'
        ]);
    }

    // Search filter
    if ($request->filled('search')) {
        $search = $request->search;
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
private function authorizeMIS($mis)
{
    $roleId = session()->get('role_id');
    $userId = session()->get('user_id');

    if ($roleId == env('adminRole_id')) return true;

    if ($roleId == env('agentRole_id') && $mis->created_by == $userId) return true;

    abort(403, 'Unauthorized');
}


//   public function store(Request $request)
// {
//     // 1️⃣ Log raw request (for debugging)
//     Log::info('MIS::store – incoming request', $request->all());

//     try {
//         // 2️⃣ Validate request
//         $validatedData = $request->validate([
//             'name'            => 'required|string|max:255',
//           'email' => 'required|email|max:255|unique:mis,email',

//             'contact'         => 'required|string|max:255',
//             'office_contact'  => 'nullable|string|max:255',
//             'product_type'    => 'required|string|max:255',
//             'bank_name'       => 'required|string|max:255',
//             'occupation'      => 'required|string|max:255',
//             'branch_name'     => 'required|string|max:255',
//             'amount'          => 'required|numeric',
//             'address'         => 'required|string',
//             'city'            => 'required|string|max:255',
//             'office_address'  => 'nullable|string|max:255',
//             'bm_name'         => 'nullable|string|max:255',
//             'login_date'      => 'nullable|date',
//             'status'          => 'nullable|string|max:255',
//             'in_principle'    => 'nullable|string|max:255',
//             'remark'          => 'nullable|string',
//             'legal'           => 'nullable|string|max:255',
//             'valuation'       => 'nullable|string|max:255',
//             'leads'           => 'nullable|string|max:255',
//             'file_work'       => 'nullable|string|max:255',
//         ]);

//         Log::info('MIS::store – validation passed', $validatedData);

//         // 3️⃣ Start transaction
//         DB::beginTransaction();

//         // 4️⃣ Insert MIS record
//        $misId = DB::table('mis')->insertGetId($validatedData);
//         Log::info('MIS::store – MIS inserted', ['mis_id' => $misId]);

//         // 5️⃣ Insert related bank details (✅ correct FK usage)
//       DB::table('company_bank_details')->insert([
//     'mis_id'          => $misId,
//     'bank_name'       => $validatedData['bank_name'],
//     'branch_name'     => $validatedData['branch_name'] ?? null,
//     'manager_name'    => $validatedData['bm_name'] ?? null,
//     'manager_number'  => null,
//     'acc_name'        => null,
//     'acc_number'      => null,
//     'ifsc_code'       => null,
//     'gst_number'      => null,
//     'pan_number'      => null,
//     'bank_address'    => null,
//     'created_at'      => now(),
//     'updated_at'      => now(),
// ]);

//         Log::info('MIS::store – company_bank_details inserted', ['mis_id' => $misId]);

//         // 6️⃣ Commit transaction
//         DB::commit();

//         // 7️⃣ Return success JSON
//         return response()->json([
//             'status'  => true,
//             'message' => 'MIS record added successfully!',
//             'id'      => $misId,
//         ], 201);

//     } catch (ValidationException $e) {

//         // Validation error
//         Log::warning('MIS::store – validation failed', [
//             'errors' => $e->errors()
//         ]);

//         return response()->json([
//             'status'  => 'error',
//             'message' => 'Validation errors occurred.',
//             'errors'  => $e->errors(),
//         ], 422);

//     } catch (\Throwable $e) {

//         // Any unexpected error
//         DB::rollBack();

//         Log::error('MIS::store – unexpected error', [
//             'message' => $e->getMessage(),
//             'line'    => $e->getLine(),
//             'file'    => $e->getFile(),
//         ]);

//         return response()->json([
//             'status'  => 'error',
//             'message' => 'Something went wrong while saving the record.',
//         ], 500);
//     }
// }

public function store(Request $request)
{
    Log::info('MIS::store – incoming request', $request->all());

    try {

        $validatedData = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:mis,email',
            'contact'      => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            'bank_name'    => 'required|string|max:255',
            'occupation'   => 'required|string|max:255',
            'branch_name'  => 'required|string|max:255',
            'amount'       => 'required|numeric',
            'address'      => 'required|string',
            'city'         => 'required|string|max:255',
            'bm_name'      => 'nullable|string|max:255',
            'login_date'   => 'nullable|date',
            'status'       => 'nullable|string|max:255',
            'in_principle' => 'nullable|string|max:255',
            'remark'       => 'nullable|string',
            'legal'        => 'nullable|string|max:255',
            'valuation'    => 'nullable|string|max:255',
            'leads'        => 'nullable|string|max:255',
            'file_work'    => 'nullable|string|max:255',
        ]);

        $userId = session()->get('user_id');

        if (!$userId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ], 401);
        }

        $validatedData['created_by'] = $userId;

        DB::transaction(function () use (&$misId, &$validatedData) {

    // Fetch by bank name only
    $bankDetail = DB::table('company_bank_details')
        ->where('bank_name', $validatedData['bank_name'])
        ->first();

    // Auto create if not exists
    if (!$bankDetail) {

        $bankId = DB::table('company_bank_details')->insertGetId([
            'bank_name'    => $validatedData['bank_name'],
            'branch_name'  => $validatedData['branch_name'] ?? null,
            'manager_name' => $validatedData['bm_name'] ?? null,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $bankDetail = (object) ['id' => $bankId];
    }

    // Save reference in MIS
    $validatedData['company_bank_detail_id'] = $bankDetail->id;

    // Insert MIS
    $misId = DB::table('mis')->insertGetId($validatedData);
});

        return response()->json([
            'status'  => 'success',
            'message' => 'MIS record added successfully!',
            'id'      => $misId,
        ], 201);

    } catch (ValidationException $e) {

        return response()->json([
            'status' => 'error',
            'errors' => $e->errors(),
        ], 422);

    } catch (\Throwable $e) {

        Log::error('MIS::store error', [
            'message' => $e->getMessage(),
        ]);

        return response()->json([
            'status'  => 'error',
            'message' => $e->getMessage(), // helpful for debugging
        ], 500);
    }
}



    public function edit($id)
    {
        $misRecord = MIS::findOrFail($id);
        $this->authorizeMIS($misRecord);
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
                'office_contact' => 'nullable|string|max:255',
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
        $this->authorizeMIS($misRecord);

        // Log existing record before update
        Log::info('Original MIS Record:', $misRecord->toArray());

        $misRecord->update($validatedData);

        // Log updated record
        Log::info('Updated MIS Record:', $misRecord->fresh()->toArray());

        return redirect()->route('admin.listlead')->with('success', 'Record updated successfully');
    }
    public function destroy(Request $request)
{
    $mis = Mis::find($request->id);

    if ($mis) {
        $mis->delete();

        return response()->json([
            'status' => true,
            'message' => 'Record deleted successfully!'
        ]);
    }

    return response()->json([
        'status' => false,
        'message' => 'Record not found!'
    ]);
}

}
