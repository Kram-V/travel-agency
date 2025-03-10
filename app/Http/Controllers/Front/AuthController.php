<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\WebsiteMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
  public function login() {
    return view('front.auth.login');
  }

  public function login_submit(Request $request) {
    $request->validate([
      'email' => ['required', 'email'],
      'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user && $user->status === '0') {
      return redirect()->back()->with('error', 'Please make sure your email is verified')->withInput();
    }

    $data = $request->only(['email', 'password']);

    if (Auth::guard('web')->attempt($data)) {
      return redirect()->route('dashboard')->with('success', 'You have logged In sucessfully');
    } else {
      return redirect()->route('login')->with('error', 'The informations you entered is incorrect. Please try again!')->withInput();
    }
  }

  public function register() {
    return view('front.auth.register');
  }

  public function register_submit(Request $request) {
    $request->validate([
      'name' => ['required'],
      'email' => ['required', 'email', 'unique:users'],
      'password' => ['required', 'min:6'],
      'confirm_password' => ['required', 'same:password'],
    ]);
    
    $existing_user = User::where('email', $request->email)->first();

    if ($existing_user) {
      return redirect()->back()->with('error', 'The email you have provided is already existing');
    }

    $token = hash('sha256', time());

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->token = $token;
    $user->save();

    $verification_link = route('verify_email', ['token' => $token, 'email' => $request->email]);

    $subject = 'User Account Verification';
    $content = "To verify your email, please click on the link: <a href='{$verification_link}'>Click Here</a>";

    Mail::to($request->email)->send(new WebsiteMail($subject, $content));

    return redirect()->route('login')->with('success', 'Email registered successfully. Please verify first your email address');
  }

  public function forget_password() {
    return view("front.auth.forget-password"); 
  }

  public function forget_password_submit(Request $request) {
    $request->validate([
      'email' => ['required', 'email'],
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
      return redirect()->back()->with('error', 'Email is not found')->withInput();
    }

    if ($user && $user->status === '0') {
      return redirect()->back()->with('error', 'Make sure your email is verified before you reset the password')->withInput();
    }

    $token = hash('sha256', time());
    $user->token = $token;
    $user->update();

    $reset_link = route('reset_password', ['token' => $token, 'email' => $user->email]);
    $subject = "Password Reset";
    $content = "To reset password, please click on the link: <a href='{$reset_link}'>Click Here</a>";

    Mail::to($request->email)->send(new WebsiteMail($subject, $content));
      
    return redirect()->back()->with('success', 'We have sent a password reset link to your email.');
  }

  public function reset_password($token, $email) {
    $user = User::where(['email' => $email, 'token' => $token])->first();

    if (!$user) {
      return redirect()->route('login')->with('error', 'It might be your token expired or email is incorrect');
    }

    return view('front.auth.reset-password', compact('token', 'email'));
  }

  public function reset_password_submit(Request $request, $token, $email) {
    $request->validate([
      'password' => 'required',
      'confirm_password' => 'required|same:password'
    ]);

    $user = User::where(['token' => $token, 'email' => $email])->first();
    $user->password = Hash::make($request->password);
    $user->token = '';
    $user->update();

    return redirect()->route('login')->with('success', 'Your password has been updated successfully');
  }

  public function verify_email($token, $email) {
    $user = User::where(['email' => $email, 'token' => $token])->first();

    if (!$user) {
      return redirect()->route('login')->with('error', 'There is something wrong with the verification of your email');
    }

    $user->token = null;
    $user->status = '1';
    $user->save();

    return redirect()->route('login')->with('success', 'Your email verified successfully');
  }

  public function logout_submit() {
    Auth::guard('web')->logout();
    return redirect()->route('home')->with('success', 'You have Logged out successfully!');
  }
}
