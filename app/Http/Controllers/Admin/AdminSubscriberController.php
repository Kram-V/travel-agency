<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminSubscriberController extends Controller
{
    public function index() {
      $subscribers = Subscriber::latest()->get();

      return view('admin.user.subscribers.index', compact('subscribers'));
    }

    public function email() {
      return view('admin.user.subscribers.email');
    }

    public function send_email(Request $request) {
      $request->validate([
        'subject' => 'required',
        'message' => 'required',
      ]);

      $subject = $request->subject;
      $content = $request->message;

      $subscribers = Subscriber::all();

      foreach($subscribers as $subscriber) {
        Mail::to($subscriber->email)->send(new WebsiteMail($subject, $content));
      }

      return redirect()->back()->with('success', 'You have sent your email to all subscribers');
    }
}
