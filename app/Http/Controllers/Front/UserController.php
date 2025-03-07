<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard() {
      return view('front.user.dashboard');
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
}
