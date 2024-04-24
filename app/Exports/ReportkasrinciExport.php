<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportkasrinciExport implements FromView
{
    public $array;
    use Exportable;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function view(): View
    {
        // dd($this->saldo_awal.$this->result.$this->kode_perk);
        return view('exports.teller.kasrinciexport', [
            'array' => $this->array,

        ]);
    }
}
