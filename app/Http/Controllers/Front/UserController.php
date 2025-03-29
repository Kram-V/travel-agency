<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Message;
use App\Models\MessageComment;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function dashboard() {
      $completed_orders = Booking::where(['user_id' => Auth::guard('web')->user()->id, 'payment_status' => 'COMPLETED'])->count();
      $pending_orders = Booking::where(['user_id' => Auth::guard('web')->user()->id, 'payment_status' => 'PENDING'])->count();
      $user_reviews = Review::where(['user_id' => Auth::guard('web')->user()->id])->count();

      return view('front.user.dashboard', compact('completed_orders', 'pending_orders', 'user_reviews'));
    }

    public function message() {
      $message = Message::where('user_id', Auth::guard('web')->user()->id)->first();

      if (!empty($message)) {
        $message_comments = MessageComment::where('message_id', $message->id)->latest()->get();
      }

      if (!empty($message_comments)) {
        return view('front.user.message', compact('message', 'message_comments'));
      }

      return view('front.user.message', compact('message'));
    }

    public function message_start() {
      $is_there_message = Message::where('user_id', Auth::guard('web')->user()->id)->first();

      if ($is_there_message) {
        return redirect()->back()->with('error', 'You have already started with the conversation');
      }

      $message = new Message();
      $message->user_id = Auth::guard('web')->user()->id;
      $message->save();

      return redirect()->back();
    }

    public function store_message(Request $request) {
      $request->validate([
        'message' => 'required'
      ]);

      $user_id = Auth::guard('web')->user()->id;

      $message = Message::where('user_id', $user_id)->first();

      $message_comment = new MessageComment();
      $message_comment->message_id = $message->id;
      $message_comment->sender_id = $user_id;
      $message_comment->type = 'customer';
      $message_comment->comment = $request->message;
      $message_comment->save();

      $link = route('admin_messages_message_details', $message->id);
      $subject = "New User's Message";
      $content = "To see the message of your customer, please click this link: <a href='{$link}'>Click Here</a>";

      $admin = Admin::first();
  
      Mail::to($admin->email)->send(new WebsiteMail($subject, $content));

      return redirect()->back()->with('success', 'Your message has been sent successfully');
    }


    public function bookings() {
      $user = Auth::guard('web')->user();
      $user_bookings = Booking::with(['package.destination', 'package_tour'])->where('user_id', $user->id)->latest()->get();

      return view('front.user.bookings', compact('user', 'user_bookings'));
    }

    public function profile() {
      $user = Auth::guard('web')->user();

      return view('front.user.profile', compact('user'));
    }

    public function update_profile(Request $request) {
      $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'country' => 'required',
        'address' => 'required',
        'name' => 'required',
        'state' => 'required',
        'city' => 'required',
        'zip' => 'required',
      ]);

      if ((strlen($request->password > 0) || strlen($request->confirm_password > 0)) && ($request->password !== $request->confirm_password)) {
        return redirect()->back()->with('error', 'Password and confirm password don\'t match');
      }

      $user = User::where('email', Auth::guard('web')->user()->email)->first();

      if ($request->photo) {
        $request->validate([
          'photo' => ['mimes:png,jpg,jpeg'],
        ]);
  
        $photo = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads/user'), $photo);
        if ($user->photo) {
          unlink(public_path('uploads/user/' . $user->photo));
        }
      } else {
        $photo = null;
      }
  
      if ($photo) $user->photo = $photo;
      $user->name = $request->name;
      $user->phone = $request->phone;
      $user->country = $request->country;
      $user->address = $request->address;
      $user->state = $request->state;
      $user->city = $request->city;
      $user->zip = $request->zip;
      if ((strlen($request->password > 0) && strlen($request->confirm_password > 0)) && ($request->password === $request->confirm_password)) $user->password = Hash::make($request->password);
      $user->update();
  
      return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function invoice($invoice_no) {
      $user_booking = Booking::with(['user', 'package', 'package_tour'])->where('invoice_no', $invoice_no)->first();
      $admin_user = Admin::first();

      return view('front.user.invoice', compact('user_booking', 'admin_user'));
    }

    public function reviews() {
      $reviews = Review::with(['user', 'package.destination'])->where('user_id', Auth::guard('web')->user()->id)->latest()->get();

      return view('front.user.reviews', compact('reviews'));
    }
}
