<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard() {
      $completed_orders = Booking::where(['user_id' => Auth::guard('web')->user()->id, 'payment_status' => 'COMPLETED'])->count();
      $pending_orders = Booking::where(['user_id' => Auth::guard('web')->user()->id, 'payment_status' => 'PENDING'])->count();

      return view('front.user.dashboard', compact('completed_orders', 'pending_orders'));
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
}
