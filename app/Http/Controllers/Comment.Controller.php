<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentPosted;

class CommentController extends Controller
{
        // 入力フォーム画面
        public function showForm()
        {
            return view('comments.form');
        }
    
        // 入力を受け付ける
        public function create(Request $request)
        {
            $user = Auth::user();
            $comment = new Comment(['body' => $request->comment]);
    
            $user->comments()->save($comment);
    
            // TODO ここでメールを送る
            Mail::to($user)->send(new CommentPosted($user, $comment));
            return redirect()->route('comment.thanks');
        }
    
        // 入力後にリダイレクトする完了画面
        public function thanks()
        {
            $comment = Auth::user()
                ->comments()
                ->orderBy('id', 'desc')
                ->first();
    
            return view('comments.thanks', compact('comment'));
        }
}
