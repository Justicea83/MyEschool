<?php

namespace App\Http\Controllers\Misc;

use App\Mail\ContactUsEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        //sendmail
        $now = Carbon::now()->addMinute(2);
        Mail::to('info@tecunitgh.com')
            ->later($now,new ContactUsEmail($request->firstname,$request->lastname,$request->message,$request->email));
      $comments = new Comment();

      $comments->fname = $request->firstname;
      $comments->lname = $request->lastname;
      $comments->email = $request->email;
      $comments->message = $request->message;

      if($comments->save()){
        return redirect()->back()->with([
          'success'=>'Message sent'
        ]);
      }
      return redirect()->back()->with([
        'error'=>'Message couldn\'t be sent'
      ]);

    }
}
