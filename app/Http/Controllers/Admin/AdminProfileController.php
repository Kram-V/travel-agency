<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
  public function profile() {
    $admin_user = Auth::guard('admin')->user();

    return view('admin.user.profile', compact('admin_user'));
  }

  public function profile_submit(Request $request) {
    $request->validate([
      'name' => 'required',
    ]);

    if ((strlen($request->password > 0) || strlen($request->confirm_password > 0)) && ($request->password !== $request->confirm_password)) {
      return redirect()->back()->with('error', 'Password and confirm password don\'t match');
    }

    $admin_user = Admin::where('email', Auth::guard('admin')->user()->email)->first();

    if ($request->photo) {
      $request->validate([
        'photo' => ['mimes:png,jpg,jpeg'],
      ]);

      $photo = time() . '.' . $request->photo->extension();
      $request->photo->move(public_path('uploads/admin'), $photo); 
      if ($admin_user->photo) {
        unlink(public_path('uploads/admin/' . $admin_user->photo));
      }
    } else {
      $photo = '';
    }

    $admin_user->name = $request->name;
    $admin_user->email = $request->email;
    if ($photo) $admin_user->photo = $photo;
    if ((strlen($request->password > 0) && strlen($request->confirm_password > 0)) && ($request->password === $request->confirm_password)) $admin_user->password = Hash::make($request->password);
    $admin_user->update();

    return redirect()->back()->with('success', 'Profile updated successfully');
  }
}
