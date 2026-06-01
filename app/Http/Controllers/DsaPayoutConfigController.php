<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DsaPayoutConfig;
use App\Models\LoanBankDetail;
use App\Models\LoanCategory;

class DsaPayoutConfigController extends Controller
{
     // LIST
    // ✅ LIST
    public function index()
{
    $configs = DsaPayoutConfig::with(['bank', 'category'])
        ->latest()
        ->paginate(10);

    return view('admin.payout_configs.index', compact('configs'));
}

    // ✅ CREATE FORM
    public function create()
    {
        $banks = LoanBankDetail::pluck('bank_name', 'bank_id');
        $categories = LoanCategory::pluck('category_name', 'loan_category_id'); // ✅ FIXED

        return view('admin.payout_configs.create', compact('banks', 'categories'));
    }

    // ✅ STORE
    public function store(Request $request)
    {
        $request->validate([
            'bank_id' => 'required|exists:loan_bank_details,bank_id',
            'loan_category_id' => 'required|exists:loan_category,loan_category_id',
            'percentage' => 'required|numeric|min:0|max:100'
        ]);

        // ✅ Prevent duplicate
        $exists = DsaPayoutConfig::where('bank_id', $request->bank_id)
            ->where('loan_category_id', $request->loan_category_id)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Config already exists');
        }

        DsaPayoutConfig::create([
            'bank_id' => $request->bank_id,
            'loan_category_id' => $request->loan_category_id,
            'percentage' => $request->percentage,
        ]);

        return redirect()->route('payout-configs.index')
            ->with('success', 'Created successfully');
    }

    // ✅ EDIT FORM
    public function edit($id)
    {
        $config = DsaPayoutConfig::findOrFail($id);

        $banks = LoanBankDetail::pluck('bank_name', 'bank_id'); // ✅ FIXED
        $categories = LoanCategory::pluck('category_name', 'loan_category_id'); // ✅ FIXED

        return view('admin.payout_configs.edit', compact('config', 'banks', 'categories'));
    }

    // ✅ UPDATE
    public function update(Request $request, $id)
    {
        $config = DsaPayoutConfig::findOrFail($id);

        $request->validate([
            'bank_id' => 'required|exists:loan_bank_details,bank_id',
            'loan_category_id' => 'required|exists:loan_category,loan_category_id',
            'percentage' => 'required|numeric|min:0|max:100'
        ]);

        // ✅ Prevent duplicate (exclude current record)
        $exists = DsaPayoutConfig::where('bank_id', $request->bank_id)
            ->where('loan_category_id', $request->loan_category_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Config already exists');
        }

        $config->update([
            'bank_id' => $request->bank_id,
            'loan_category_id' => $request->loan_category_id,
            'percentage' => $request->percentage,
        ]);

        return redirect()->route('payout-configs.index')
            ->with('success', 'Updated successfully');
    }

    // ✅ DELETE
    public function destroy($id)
    {
        $config = DsaPayoutConfig::findOrFail($id);
        $config->delete();

        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
