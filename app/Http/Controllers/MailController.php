<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//メール
use Illuminate\Support\Facades\Mail;
use App\Mail\MailPost;

class MailController extends Controller
{
    public function mailSend(Request $request){
        
        Mail::to($request->email)->send(new MailPost($request->email));
        return;
    }
}
