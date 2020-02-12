<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryPosted extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $content;
    public $tel;
    public $mail;
    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$content,$tel,$mail,$details)
    {
        $this->name = $name;
        $this->content = $content;
        $this->tel = $tel;
        $this->mail = $mail;
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        //メールのタイトル
        ->subject('問い合わせが送られてきました')
        //内容
        ->view('emails.posted');
    }
}
