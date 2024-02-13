<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportNominGrpKDGRP1DepExport implements FromView
{
    public $array;
    use Exportable;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function view(): View
    {
        return view('exports.deposito.nominatifgrpperKDGRP1excel',[
            'nomin'=>$this->array
        ]);
    }
}
