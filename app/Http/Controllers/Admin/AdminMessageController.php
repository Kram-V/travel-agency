<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Message;
use App\Models\MessageComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminMessageController extends Controller
{
    public function messages() {
      $messages = Message::with('user')->latest()->get();

      return view('admin.user.user-section.messages.index', compact('messages'));
    }

    public function message_details($id) {
      $message = Message::with('user')->where('id', $id)->first();
      $message_comments = MessageComment::where('message_id', $id)->latest()->get();

      return view('admin.user.user-section.messages.details', compact('message', 'message_comments'));
    }

    public function store_message(Request $request) {
      $request->validate([
        'message' => 'required'
      ]);

      $message_comment = new MessageComment();
      $message_comment->message_id = $request->message_id;
      $message_comment->sender_id = Auth::guard('admin')->user()->id;
      $message_comment->type = 'admin';
      $message_comment->comment = $request->message;
      $message_comment->save();

      $link = route('message');
      $subject = "New Admin's Message";
      $content = "The admin replied to your message, please click this link to see the message: <a href='{$link}'>Click Here</a>";
  
      Mail::to($request->customer_email)->send(new WebsiteMail($subject, $content));

      return redirect()->back()->with('success', 'You message has been sent successfully');
    }

    public function users() {
      return view('admin.user.user-section.users.index');
    }
    
}
