<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportbukubesarHelperExport implements FromView
{
    public $saldo_awal,$result,$kode_perk,$nama_perk,$dk;
    use Exportable;

    public function __construct(array $saldo_awal,$result,$kode_perk,$nama_perk,$dk)
    {
        $this->saldo_awal = $saldo_awal;
        $this->result = $result;
        $this->kode_perk = $kode_perk;
        $this->nama_perk = $nama_perk;
        $this->dk = $dk;

    }

    public function view(): View
    {
        // dd($this->saldo_awal.$this->result.$this->kode_perk);
        return view('exports.akuntansi.bukubesarpembantuexport',[
            'saldo_awal'=>$this->saldo_awal,
            'result'=>$this->result,
            'kode_perk'=>$this->kode_perk,
            'nama_perk'=>$this->nama_perk,
            'dk'=>$this->dk

        ]);
    }

}
