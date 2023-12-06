<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportNeracaKomparatifExport implements FromView
{
    public $result,$totdebetpend,$totkreditpend,$totdebetby,$totkreditby,$tgl_trans1,$tgl_trans2;
    use Exportable;

    public function __construct(array $result,$totdebetpend,$totkreditpend,$totdebetby,$totkreditby,$tgl_trans1,$tgl_trans2)
    {
        $this->result = $result;
        $this->totdebetpend = $totdebetpend;
        $this->totkreditpend = $totkreditpend;
        $this->totdebetby = $totdebetby;
        $this->totkreditby = $totkreditby;
        $this->tgl_trans1 = $tgl_trans1;
        $this->tgl_trans2 = $tgl_trans2;

    }

    public function view(): View
    {
        // dd($this->saldo_awal.$this->result.$this->kode_perk);
        return view('exports.akuntansi.exportneracakomparatif',[
            'rstrial'=>$this->result,
            'totdebetpend'=>$this->totdebetpend,
            'totkreditpend'=>$this->totkreditpend,
            'totdebetby'=>$this->totdebetby,
            'totkreditby'=>$this->totkreditby,
            'tgl_trans1'=>$this->tgl_trans1,
            'tgl_trans2'=>$this->tgl_trans2,

        ]);
    }

}
