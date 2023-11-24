<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportneracascontroExport implements FromView
{
    public $neraca,$totaktiva,$laba;
    use Exportable;

    public function __construct(array $neraca,$totaktiva,$laba)
    {
        $this->neraca = $neraca;
        $this->totaktiva = $totaktiva;
        $this->laba = $laba;
    }

    public function view(): View
    {
        return view('exports.akuntansi.exportneraca',[
            'rsneraca'=>$this->neraca,
            'totaktiva'=>$this->totaktiva,
            'laba'=>$this->laba
        ]);
    }

}
