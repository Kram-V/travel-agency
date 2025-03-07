<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminAuthController extends Controller 
{
    public function login() {
      return view('admin.auth.login');
    }

    public function login_submit(Request $request) {
      $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required']
      ]);

      $data = $request->only(['email', 'password']);

      if (Auth::guard('admin')->attempt($data)) {
        return redirect()->route('admin_dashboard')->with('success', 'You have logged In sucessfully')->withInput();
      } else {
        return redirect()->route('admin_login')->with('error', 'The informations you entered is incorrect. Please try again!')->withInput();
      }
    }

    public function logout_submit() {
      Auth::guard('admin')->logout();
      return redirect()->route('admin_login')->with('success', 'You have Logged out successfully!');
    }

    public function forget_password() {
      return view('admin.auth.forget-password');
    }

    public function forget_password_submit(Request $request) {
      $request->validate([
        'email' => ['required', 'email'],
      ]);

      $admin = Admin::where('email', $request->email)->first();

      if (!$admin) {
        return redirect()->back()->with('error', 'Email is not found');
      }

      $token = hash('sha256', time());
      $admin->token = $token;
      $admin->update();

      $reset_link = url("admin/reset-password/{$token}/{$request->email}");
      $subject = "Password Reset";
      $content = "To reset password, please click on the link: <a href='{$reset_link}'>Click Here</a>";

      Mail::to($request->email)->send(new WebsiteMail($subject, $content));
        
      return redirect()->back()->with('success', 'We have sent a password reset link to your email.');
    }

    public function reset_password($token, $email) {
      $admin = Admin::where(['email' => $email, 'token' => $token])->first();

      if (!$admin) {
        return redirect()->route('admin_login')->with('error', 'It might be your token expired or email is incorrect');
      }

      return view('admin.auth.reset-password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request, $token, $email) {
      $request->validate([
        'password' => 'required',
        'confirm_password' => 'required|same:password'
      ]);

      $admin = Admin::where(['token' => $token, 'email' => $email])->first();
      $admin->password = Hash::make($request->password);
      $admin->token = '';
      $admin->update();

      return redirect()->route('admin_login')->with('success', 'Your password has been updated successfully');
    }
}
