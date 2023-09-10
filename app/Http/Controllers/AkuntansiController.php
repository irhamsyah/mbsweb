<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Logo;
use App\Kodetranstabungan;
use App\Kodecabang;
use App\Tabtran;
use Illuminate\Support\Facades\Auth;

class AkuntansiController extends Controller
{
    public function bo_ak_tt_postingdatatransaksi()
    {   
        $users = User::all();
        $logos = Logo::all();
        return view('');
    }
}
