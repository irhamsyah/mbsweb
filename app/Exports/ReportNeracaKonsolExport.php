<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportNeracaKonsolExport implements FromView
{
    public $result;
    use Exportable;

    public function __construct(array $result)
    {
        $this->result = $result;

    }

    public function view(): View
    {
        // dd($this->saldo_awal.$this->result.$this->kode_perk);
        return view('exports.akuntansi.neracakonsol1export',[
            'result'=>$this->result
        ]);
    }

}
