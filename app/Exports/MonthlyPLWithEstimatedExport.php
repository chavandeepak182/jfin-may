<?php

namespace App\Exports;

use App\Models\MonthlyPL;
use App\Exports\Sheets\EstimatedFilesSheet;
use App\Exports\Sheets\MonthlyPLSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MonthlyPLWithEstimatedExport implements WithMultipleSheets
{
    protected $pl;

    public function __construct(MonthlyPL $pl)
    {
        $this->pl = $pl;
    }

    public function sheets(): array
    {
        return [
            new EstimatedFilesSheet($this->pl->month, $this->pl->year),
            new MonthlyPLSheet($this->pl),
        ];
    }
}
