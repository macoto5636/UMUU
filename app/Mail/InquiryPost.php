<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryPost extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $title;
    public $tel;
    public $mail;
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$title,$tel,$mail,$content)
    {
        $this->name = $name;
        $this->title = $title;
        $this->tel = $tel;
        $this->mail = $mail;
        $this->content = $content;
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
        ->view('email.inquiryPost');
    }
}
