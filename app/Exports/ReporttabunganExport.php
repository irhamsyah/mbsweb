<?php

namespace App\Exports;

use App\Tabungan;
use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Facades\DB;

class ReporttabunganExport implements FromView
{
    public $array;
    use Exportable;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function view(): View
    {
        return view('exports.nominatifexcel',[
            'nomin'=>$this->array
        ]);
    }
}
