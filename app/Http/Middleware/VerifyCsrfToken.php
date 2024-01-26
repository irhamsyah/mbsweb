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
    ];
}
