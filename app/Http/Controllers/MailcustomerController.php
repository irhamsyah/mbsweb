<?php

namespace App\Http\Controllers;

use App\Mail\MailSignupcustEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

// use Illuminate\Http\Request;

class MailcustomerController extends Controller
{
    //
    public static function sendSignupEmail($name, $email, $verification_code){
        $data = [
            'name' => $name,
            'verification_code' => $verification_code
        ];
        Mail::to($email)->send(new MailSignupcustEmail($data));
    }

}
