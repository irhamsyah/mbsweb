<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportRekapJurnalHarianExport implements FromView
{
    public $result;
    use Exportable;

    public function __construct(array $result)
    {
        $this->result = $result;
    }

    public function view(): View
    {
        // dd($this->result);
        return view('exports.akuntansi.exportrekapjurnal',[
            'result'=>$this->result
        ]);
    }

}
