<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportJadwalBayarBungaExport implements FromView
{
    public $array, $tgltrs1;
    use Exportable;

    public function __construct(array $array, $tgltrs1)
    {
        $this->array = $array;
        $this->tgltrs1 = $tgltrs1;
    }

    public function view(): View
    {
        return view('exports.deposito.exportjadwalbyrbunga', [
            'transaksi' => $this->array,
            'tgltrs1' => $this->tgltrs1

        ]);
    }
}
