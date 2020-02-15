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

    //問い合わせ内容を228kuri@gmail.comに送る
    public function inquirySend(Request $request){

        Mail::to("228kuri@gmail.com")->send(new InquiryPost(request("name"), request("title"), request("tel"),request("email"),request("content")));
        $this->VerificationSend(request("email"),request("name"), request("title"), request("content"));
    }

    //問い合わせを送信した相手に確認メールを送る
    public function VerificationSend($email, $name, $title, $content){

        Mail::to($email)->send(new VerificatioPost($name, $title, $content));
        return;

    }
}
