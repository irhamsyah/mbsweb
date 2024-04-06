<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TellerKasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // SHOW FORM KAS UMUM

}
