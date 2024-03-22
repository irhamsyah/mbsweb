<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportOBBungaToTitpanExport implements FromView
{
    public $array,$user;
    use Exportable;

    public function __construct(array $array,$user)
    {
        $this->array = $array;
        $this->user = $user;

    }

    public function view(): View
    {
        return view('exports.deposito.obbungatotitipanexcel',[
            'nomin'=>$this->array
        ]);
    }
}
