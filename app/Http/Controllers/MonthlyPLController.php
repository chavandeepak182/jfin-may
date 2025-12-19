<?php

namespace App\Http\Controllers;

use App\Models\MonthlyPL;
use Illuminate\Http\Request;
use App\Exports\MonthlyPLFormattedExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MonthlyPLWithEstimatedExport;

class MonthlyPLController extends Controller
{
    public function store(Request $request)
{
    MonthlyPL::updateOrCreate(
        [
            'month' => $request->month,
            'year'  => $request->year,
        ],
        $request->except('_token')
    );

    return response()->json([
        'success' => true,
        'message' => 'Monthly P&L saved successfully'
    ]);
}
public function exportExcel($id)
{
    $pl = MonthlyPL::findOrFail($id);
    return Excel::download(new MonthlyPLExport($pl), 'Monthly_PL.xlsx');
}
public function exportPdf($id)
{
    $pl = MonthlyPL::findOrFail($id);
    return Pdf::loadView('monthly-pl.pdf', compact('pl'))
              ->download('Monthly_PL.pdf');
}
public function exportFormattedExcel($id)
{
    $pl = MonthlyPL::findOrFail($id);

    return Excel::download(
        new MonthlyPLFormattedExport($pl),
        'P&L_'.$pl->month.'_'.$pl->year.'.xlsx'
    );
}
public function list()
{
    $pls = MonthlyPL::orderBy('year', 'desc')
                    ->orderBy('month', 'desc')
                    ->get();

    return view('estimated-files.list', compact('pls'));
}
public function exportWithEstimated($id)
{
    $pl = MonthlyPL::findOrFail($id);

    return Excel::download(
        new MonthlyPLWithEstimatedExport($pl),
        'Monthly_PL_'.$pl->month.'_'.$pl->year.'.xlsx'
    );
}
}
