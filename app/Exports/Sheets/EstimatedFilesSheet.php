<?php

namespace App\Exports\Sheets;

use App\Models\EstimatedFile;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EstimatedFilesSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    protected $month;
    protected $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year  = $year;
    }

    public function collection()
    {
        $data = EstimatedFile::query()
            ->leftJoin('loan_bank_details as b', 'b.bank_id', '=', 'estimated_files.bank_id')
            ->whereYear('estimated_files.report_month', $this->year)
            ->whereMonth('estimated_files.report_month', $this->month)
            ->select([
                'estimated_files.report_month',
                'estimated_files.app_no',
                'estimated_files.los_no',
                'estimated_files.bm_ch_name',
                'estimated_files.sub_manager',
                'estimated_files.product',
                'estimated_files.sub_product',
                'estimated_files.customer_name',
                'estimated_files.net_amt_disbursed',
                'estimated_files.estimate_revenue',
                'estimated_files.est_net_percent',
                'estimated_files.dsa_payout_percent',
                'estimated_files.est_dsa_payout_amt',
                'estimated_files.tds',
                'estimated_files.net_revenue',
                'estimated_files.emp_name',
                'estimated_files.emp_code',
                'estimated_files.dsa_name',
                'estimated_files.dsa_code',
                'b.bank_name',
                'b.ifsc_code as bank_code',
                'estimated_files.source',
                'estimated_files.mobile',
                'estimated_files.email',
                'estimated_files.pan',
                'estimated_files.aadhaar',
            ])
            ->orderBy('estimated_files.id')
            ->get();

        return $data->map(function ($row, $index) {
            return [
                $index + 1,
                Carbon::parse($row->report_month)->format('M'),
                $row->app_no,
                $row->los_no,
                $row->bm_ch_name,
                $row->sub_manager,
                $row->product,
                $row->sub_product,
                $row->customer_name,
                $row->net_amt_disbursed,
                $row->estimate_revenue,
                $row->est_net_percent . '%',
                $row->dsa_payout_percent . '%',
                $row->est_dsa_payout_amt,
                $row->tds,
                $row->net_revenue,
                $row->emp_name,
                $row->emp_code,
                $row->dsa_name,
                $row->dsa_code,
                $row->bank_name,
                $row->bank_code,
                $row->source,
                $row->mobile,
                $row->email,
                $row->pan,
                $row->aadhaar,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Sr No',
            'Report Month',
            'App No/LOS No',
            'LOS No',
            'BM/CH Name',
            'Sub Manager',
            'Product',
            'Sub Product',
            'Customer Name',
            'Net Amt Disbursed',
            'Est Revenue',
            'Est Net %',
            'DSA Payout %',
            'Est DSA Payout Amt',
            'TDS',
            'Net Rev',
            'EMP Name',
            'EMP Code',
            'DSA Name',
            'DSA Code',
            'Bank Name',
            'Bank Code',
            'Source',
            'Mobile',
            'Mail',
            'PAN',
            'AADHAR',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Header row
            1 => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => 'center'],
            ],

            // Highlighted finance columns (same as screenshot)
            'J1' => ['fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'C6EFCE']]],
            'K1' => ['fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'F4B084']]],
            'M1' => ['fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'C6EFCE']]],
            'N1' => ['fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'FFD966']]],
            'O1' => ['fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'FFD966']]],
            'P1' => ['fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'C6EFCE']]],
            'X1' => ['fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'FCE4D6']]],
            'Y1' => ['fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'FCE4D6']]],
            'Z1' => ['fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'FCE4D6']]],
            'AA1'=> ['fill' => ['fillType'=>'solid','startColor'=>['rgb'=>'FCE4D6']]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 10,
            'C' => 18,
            'D' => 12,
            'E' => 18,
            'F' => 15,
            'G' => 10,
            'H' => 12,
            'I' => 18,
            'J' => 16,
            'K' => 14,
            'L' => 10,
            'M' => 12,
            'N' => 16,
            'O' => 12,
            'P' => 14,
            'Q' => 14,
            'R' => 12,
            'S' => 14,
            'T' => 12,
            'U' => 18,
            'V' => 12,
            'W' => 10,
            'X' => 12,
            'Y' => 16,
            'Z' => 12,
            'AA'=> 14,
        ];
    }

    public function title(): string
    {
        return 'Estimated Files';
    }
}
