<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ReporttabunganpasifExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $array;
    use Exportable;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function view(): View
    {
        return view('exports.nominatiftabpasifexcel',[
            'nomin'=>$this->array
        ]);
    }
}
