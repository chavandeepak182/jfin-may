<?php

namespace App\Http\Controllers;
use App\Models\EstimatedFile;
use App\Models\LoanBankDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EstimatedFileController extends Controller
{
    public function index(Request $request)
{
    $query = EstimatedFile::query();

    // 🔍 Search (Customer Name / Mobile)
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('customer_name', 'like', '%' . $request->search . '%')
              ->orWhere('mobile', 'like', '%' . $request->search . '%');
        });
    }

    $grossRevenue = 0;

    // 📅 Month-Year filter (YYYY-MM)
    if ($request->filled('report_month')) {
        $date = Carbon::createFromFormat('Y-m', $request->report_month);

        $query->whereYear('report_month', $date->year)
              ->whereMonth('report_month', $date->month);

        // 🔢 Gross Revenue = SUM(estimate_revenue)
        $grossRevenue = (clone $query)->sum('estimate_revenue');
    }

    $estimatedFiles = $query->orderBy('id', 'desc')->get();

    return view(
        'estimated-files.index',
        compact('estimatedFiles', 'grossRevenue')
    );
}
    public function create()
    {
        $banks = LoanBankDetail::select('bank_id', 'bank_name', 'ifsc_code')->get();
        return view('estimated-files.create', compact('banks'));
    }

    public function store(Request $request)
{
    $request->validate([
        'report_month'       => 'required|regex:/^\d{4}-\d{2}$/',
        'customer_name'      => 'required|string|max:150',
        'bank_id'            => 'required|exists:loan_bank_details,bank_id',

        'net_amt_disbursed'  => 'required|numeric|min:0',
        'est_net_percent'    => 'required|numeric|min:0',
        'dsa_payout_percent' => 'required|numeric|min:0',

        'app_no'             => 'nullable|string|max:50',
        'bm_ch_name'         => 'nullable|string|max:100',
        'sub_manager'        => 'nullable|string|max:100',
        'product'            => 'nullable|string|max:100',
        'sub_product'        => 'nullable|string|max:100',
        'emp_name'           => 'nullable|string|max:100',
        'emp_code'           => 'nullable|string|max:50',
        'dsa_name'           => 'nullable|string|max:150',
        'dsa_code'           => 'nullable|string|max:50',
        'source'             => 'nullable|string|max:100',
        'mobile'             => 'nullable|string|max:15',
        'email'              => 'nullable|email|max:150',
        'pan'                => 'nullable|string|max:15',
        'aadhaar'            => 'nullable|string|max:20',
    ]);

    $data = $request->all();

    // 📅 Month handling
    $data['report_month'] = Carbon::createFromFormat('Y-m', $request->report_month)
                                    ->startOfMonth();

    // 💰 FORMULA CALCULATION (BACKEND)
    $netAmt   = $request->net_amt_disbursed;
    $netPct   = $request->est_net_percent;
    $dsaPct   = $request->dsa_payout_percent;

    $estimateRevenue   = ($netAmt * $netPct) / 100;
    $dsaPayoutAmt      = ($netAmt * $dsaPct) / 100;
    $tds               = ($estimateRevenue * 5) / 100;
    $netRevenue        = $estimateRevenue - $dsaPayoutAmt - $tds;

    $data['estimate_revenue']    = round($estimateRevenue, 2);
    $data['est_dsa_payout_amt']  = round($dsaPayoutAmt, 2);
    $data['tds']                 = round($tds, 2);
    $data['net_revenue']         = round($netRevenue, 2);

    EstimatedFile::create($data);

    return redirect()
        ->route('estimatedFile.index')
        ->with('success', 'Estimated File Added Successfully');
}
    public function edit($id)
    {
        $estimatedFile = EstimatedFile::findOrFail($id);
        $banks = LoanBankDetail::select('bank_id', 'bank_name', 'ifsc_code')->get();

        return view('estimated-files.edit', compact('estimatedFile', 'banks'));
    }

    public function show($id)
{
    $estimatedFile = EstimatedFile::findOrFail($id);

    return view('estimated-files.show', compact('estimatedFile'));
}


   public function update(Request $request, $id)
    {
        $request->validate([
            'report_month'       => 'required|regex:/^\d{4}-\d{2}$/',
            'customer_name'      => 'required|string|max:150',
            'bank_id'            => 'required|exists:loan_bank_details,bank_id',

            'net_amt_disbursed'  => 'required|numeric|min:0',
            'est_net_percent'    => 'required|numeric|min:0',
            'dsa_payout_percent' => 'required|numeric|min:0',

            'app_no'             => 'nullable|string|max:50',
            'bm_ch_name'         => 'nullable|string|max:100',
            'sub_manager'        => 'nullable|string|max:100',
            'product'            => 'nullable|string|max:100',
            'sub_product'        => 'nullable|string|max:100',
            'emp_name'           => 'nullable|string|max:100',
            'emp_code'           => 'nullable|string|max:50',
            'dsa_name'           => 'nullable|string|max:150',
            'dsa_code'           => 'nullable|string|max:50',
            'source'             => 'nullable|string|max:100',
            'mobile'             => 'nullable|string|max:15',
            'email'              => 'nullable|email|max:150',
            'pan'                => 'nullable|string|max:15',
            'aadhaar'            => 'nullable|string|max:20',
        ]);

        $estimatedFile = EstimatedFile::findOrFail($id);

        $data = $request->all();

        // 📅 Month conversion
        $data['report_month'] = Carbon::createFromFormat('Y-m', $request->report_month)
                                        ->startOfMonth();

        // 💰 AUTO CALCULATION (SAME AS STORE)
        $netAmt = $request->net_amt_disbursed;
        $netPct = $request->est_net_percent;
        $dsaPct = $request->dsa_payout_percent;

        $estimateRevenue  = ($netAmt * $netPct) / 100;
        $dsaPayoutAmt     = ($netAmt * $dsaPct) / 100;
        $tds              = ($estimateRevenue * 5) / 100;
        $netRevenue       = $estimateRevenue - $dsaPayoutAmt - $tds;

        $data['estimate_revenue']   = round($estimateRevenue, 2);
        $data['est_dsa_payout_amt'] = round($dsaPayoutAmt, 2);
        $data['tds']                = round($tds, 2);
        $data['net_revenue']        = round($netRevenue, 2);

        $estimatedFile->update($data);

        return redirect()
            ->route('estimatedFile.index')
            ->with('success', 'Estimated File Updated Successfully');
    }

    public function destroy($id)
    {
        $estimatedFile = EstimatedFile::findOrFail($id);
        $estimatedFile->delete();

        return redirect()
            ->route('estimatedFile.index')
            ->with('success', 'Estimated File Deleted Successfully');
    }
   public function indexPL()
    {
        return view('estimated-files.p-and-l');
    }

    public function getGrossRevenue(Request $request)
    {
        $gross = EstimatedFile::whereYear('report_month', $request->year)
            ->whereMonth('report_month', $request->month)
            ->sum('estimate_revenue');

        return response()->json([
            'gross' => round($gross, 2)
        ]);
    }
}
