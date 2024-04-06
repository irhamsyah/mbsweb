<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/home',
        '/',
        '/login',
        'bo_dep_update_bngpjk',
        'bo_tb_de_hitungbungadep',
        'bo_dp_rp_nominatifrinci',
        'bo_dp_rp_nominatifgrouprinci',
        'bo_dp_rp_transaksirinci',
        'bo_dp_rp_mutasibunga',
        'exporttoexcelmutasibngdep',
        'bo_dp_rp_obbungaketitipan',
        'bo_dp_rp_bungapajakdep',
        'bo_dp_rp_frmjadwaldeposito',
        'bo_tl_td_pengambilanbungadeposito',
        'bo_dep_del_trs',
        'bo_dp_de_overbookbngdep',
        'bo_tl_td_penutupandeposito',
        'bo_tl_td_setorandeposito',
        'bo_dp_de_deposito',
        'bo_ak_tt_simpancatatjurnal',
        'logout'
    ];
}
