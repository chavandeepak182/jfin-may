<?php

namespace App\Exports;
use App\Models\Mis;
use Maatwebsite\Excel\Concerns\FromCollection;

class MisExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mis::all();
    }
}
