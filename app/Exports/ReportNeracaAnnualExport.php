<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportNeracaAnnualExport implements FromView
{
    public $result,$tgl_trans1,$tgl_trans2,$tgl_trans3,$totaktiva1,$totpasiva1,$laba1,$totaktiva2,$totpasiva2,$laba2,$totaktiva3,$totpasiva3,$laba3;
    use Exportable;

    public function __construct(array $result,$tgl_trans1,$tgl_trans2,$tgl_trans3,$totaktiva1,$totpasiva1,$laba1,$totaktiva2,$totpasiva2,$laba2,$totaktiva3,$totpasiva3,$laba3)
    {

        $this->result = $result;
        $this->tgl_trans1 = $tgl_trans1;
        $this->tgl_trans2 = $tgl_trans2;
        $this->tgl_trans3 = $tgl_trans3;
        $this->totaktiva1 = $totaktiva1;
        $this->totpasiva1 = $totpasiva1;
        $this->laba1 = $laba1;
        $this->totaktiva2 = $totaktiva2;
        $this->totpasiva2 = $totpasiva2;
        $this->laba2 = $laba2;
        $this->totaktiva3 = $totaktiva3;
        $this->totpasiva3 = $totpasiva3;
        $this->laba3 = $laba3;

    }

    public function view(): View
    {
        // dd($this->saldo_awal.$this->result.$this->kode_perk);
        return view('exports.akuntansi.exportneracaannual',[
            'rsneraca'=>$this->result,
            'tgl_trans1'=>$this->tgl_trans1,
            'tgl_trans2'=>$this->tgl_trans2,
            'tgl_trans3'=>$this->tgl_trans3,
            'totaktiva1'=>$this->totaktiva1,
            'totpasiva1'=>$this->totpasiva1,
            'laba1'=>$this->laba1,
            'totaktiva2'=>$this->totaktiva2,
            'totpasiva2'=>$this->totpasiva2,
            'laba2'=>$this->laba2,
            'totaktiva3'=>$this->totaktiva3,
            'totpasiva3'=>$this->totpasiva3,
            'laba3'=>$this->laba3,
        ]);
    }

}
