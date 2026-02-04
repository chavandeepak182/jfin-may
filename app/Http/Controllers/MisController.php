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

    // Admin → full access
    if ($roleId == config('constants.roles.admin')) {
        return true;
    }

    // Agent → only own recordsad
    if (
        $roleId == config('constants.roles.agent') &&
        (int) $mis->created_by === (int) $userId
    ) {
        return true;
    }

    abort(403, 'Unauthorized MIS access');
}


public function store(Request $request)
{
    Log::info('MIS::store – incoming request', $request->all());

    try {

        // $validatedData = $request->validate([
        //     'name'         => 'required|string|max:255',
        //     'email'        => 'required|email|max:255|unique:mis,email',
        //     'contact'      => 'required|string|max:255',
        //     'product_type' => 'required|string|max:255',
        //     'bank_name'    => 'required|string|max:255',
        //     'occupation'   => 'required|string|max:255',
        //     'branch_name'  => 'required|string|max:255',
        //     'amount'       => 'required|numeric',
        //     'address'      => 'required|string',
        //     'city'         => 'required|string|max:255',
        //     'bm_name'      => 'nullable|string|max:255',
        //     'login_date'   => 'nullable|date',
        //     'status'       => 'nullable|string|max:255',
        //     'in_principle' => 'nullable|string|max:255',
        //     'remark'       => 'nullable|string',
        //     'legal'        => 'nullable|string|max:255',
        //     'valuation'    => 'nullable|string|max:255',
        //     'leads'        => 'nullable|string|max:255',
        //     'file_work'    => 'nullable|string|max:255',
        // ]);
       $validatedData = $request->validate([
    'name' => [
        'required',
        'string',
        'max:255',
        'regex:/^[a-zA-Z\s]+$/'
    ],

    'email' => 'required|email|max:255',

    'contact' => 'required|digits_between:10,12',

    'product_type' => 'required|string',
    'occupation'   => 'required|string',

    'bank_name'    => 'required|string|max:255',

    'branch_name' => [
        'required',
        'string',
        'max:255',
        'regex:/^[a-zA-Z\s]+$/'
    ],

    // 🔒 LOGIN DATE – today or past only
    'login_date' => [
        'nullable',
        'date',
        'before_or_equal:today'
    ],

    'status'       => 'required|in:open,processing,closed',
    'in_principle' => 'nullable|in:yes,no',

    'amount' => 'required|numeric|min:1',

    'city' => [
        'required',
        'string',
        'max:100',
        'regex:/^[a-zA-Z\s]+$/'
    ],

    'address' => 'required|string',

],[
    'name.required'  => 'Name is required',
    'name.regex'     => 'Name should contain only letters',

    'email.required' => 'Email is required',
    'email.email'    => 'Enter valid email',

    'contact.required'       => 'Contact number is required',
    'contact.digits_between' => 'Contact must be 10–12 digits',

    'product_type.required' => 'Product Type is required',
    'occupation.required'   => 'Occupation is required',

    'bank_name.required'    => 'Bank Name is required',

    'branch_name.required'  => 'Branch Name is required',
    'branch_name.regex'     => 'Branch Name should contain only letters',

    'login_date.before_or_equal' => 'Login Date cannot be a future date',

    'status.required' => 'Status is required',

    'amount.required' => 'Amount is required',
    'amount.numeric'  => 'Amount must be numeric',

    'city.required' => 'City is required',
    'city.regex'    => 'City should contain only letters',

    'address.required' => 'Address is required',
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
    'status'  => true,
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
