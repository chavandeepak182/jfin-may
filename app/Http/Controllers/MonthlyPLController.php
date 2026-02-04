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
// public function list()
// {
//     $pls = MonthlyPL::orderBy('year', 'desc')
//                     ->orderBy('month', 'desc')
//                     ->get();

//     return view('estimated-files.list', compact('pls'));
// }
public function list(Request $request)
{
    $pls = MonthlyPL::query();

    if ($request->filled('search')) {

        $search = strtolower(trim($request->search));
        $parts  = explode(' ', $search);

        $monthMap = [
            'jan' => 1, 'january' => 1,
            'feb' => 2, 'february' => 2,
            'mar' => 3, 'march' => 3,
            'apr' => 4, 'april' => 4,
            'may' => 5,
            'jun' => 6, 'june' => 6,
            'jul' => 7, 'july' => 7,
            'aug' => 8, 'august' => 8,
            'sep' => 9, 'september' => 9,
            'oct' => 10, 'october' => 10,
            'nov' => 11, 'november' => 11,
            'dec' => 12, 'december' => 12,
        ];

        $month = null;
        $year  = null;

        foreach ($parts as $part) {
            if (isset($monthMap[$part])) {
                $month = $monthMap[$part];
            }

            if (is_numeric($part) && strlen($part) == 4) {
                $year = $part;
            }
        }

        $pls->where(function ($q) use ($month, $year) {
            if ($month) {
                $q->where('month', $month);
            }
            if ($year) {
                $q->where('year', $year);
            }
        });
    }

    $pls = $pls->orderBy('year', 'desc')
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


// show
public function show($id)
{
    $pl = MonthlyPL::findOrFail($id);

    return view('estimated-files.view', compact('pl'));
}

}
