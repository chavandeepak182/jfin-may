<?php

namespace App\Exports;

use App\Models\EligibilityCriteria;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Support\Responsable;


class EligibilityExport implements FromCollection
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

//     public function Eligiblelist()
// {
//     // Example queries if needed:
//     // $leads = DB::table('leads')->count();
//     // $totalmis = DB::table('mis')->count();

//     return view('admin.allEligiblel'); // loads admin/Eligible.blade.php
// }

    
}
