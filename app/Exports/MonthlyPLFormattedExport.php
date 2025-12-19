<?php

namespace App\Exports;

use App\Models\MonthlyPL;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MonthlyPLFormattedExport implements FromArray, WithStyles, WithColumnWidths
{
    protected $pl;

    public function __construct(MonthlyPL $pl)
    {
        $this->pl = $pl;
    }

    public function array(): array
    {
        return [
            ['P&L', date('M-y', mktime(0,0,0,$this->pl->month,1,$this->pl->year))],

            ['Revenue'],
            ['Gross Revenue – Loan', $this->pl->gross_revenue],
            ['Insurance', $this->pl->insurance],
            ['Revenue Total', $this->pl->revenue_total],

            [''],
            ['Salary / Incentive / Broker'],
            ['Staff Cost', $this->pl->staff_cost],
            ['Staff Incentive', $this->pl->staff_incentive],
            ['Broker Commission', $this->pl->broker_commission],
            ['Salary.Incen.Brok', $this->pl->salary_total],

            [''],
            ['Administration & General Overheads'],
            ['Rental', $this->pl->rental],
            ['Total Opex', $this->pl->opex],
            ['Admin Overheads', $this->pl->admin_overheads],

            [''],
            ['Selling & Distribution Overheads'],

            [''],
            ['Cost'],
            ['CSO Cost', $this->pl->cso_cost],
            ['Admin / Fixed Cost', $this->pl->admin_fixed_cost],
            ['Travelling / Misc', $this->pl->travel_cost],
            ['TDS', $this->pl->tds],
            ['Cost', $this->pl->cost_total],

            [''],
            ['Total Cost', $this->pl->total_cost],
            ['Net Profit', $this->pl->net_profit],
            ['Manager P&L', $this->pl->manager_pl],
            ['Net To Company', $this->pl->net_company],
            ['Net Retention %', round(($this->pl->net_company / $this->pl->revenue_total) * 100, 2) . '%'],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1  => ['font' => ['bold' => true], 'fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'00B050']]],
            2  => ['font' => ['bold' => true], 'fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'BDD7EE']]],
            5  => ['font' => ['bold' => true], 'fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'D9E1F2']]],
            7  => ['font' => ['bold' => true], 'fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'F4B084']]],
            11 => ['font' => ['bold' => true], 'fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'E2EFDA']]],
            14 => ['font' => ['bold' => true], 'fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'E2EFDA']]],
            18 => ['font' => ['bold' => true], 'fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'FFD966']]],
            24 => ['font' => ['bold' => true], 'fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'FFD966']]],
            25 => ['font' => ['bold' => true], 'fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'00B0F0']]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 40,
            'B' => 20,
        ];
    }
}
