@extends('front.layout.master')

@section('content')
<div class="page-top" style="background-image: url('images/banner.jpg')">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>Login</h2>
              <div class="breadcrumb-container">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                      <li class="breadcrumb-item active">Login</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="page-content pt_70 pb_70">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
              <div class="login-form">
                  <form action="{{ route('login_submit') }}" method="POST">
                      @csrf
                      <div class="mb-3">
                          <label for="email" class="form-label">Email Address *</label>
                          <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                      </div>
                      <div class="mb-3">
                          <label for="password" class="form-label">Password *</label>
                          <input type="password" class="form-control" name="password" id="password">
                      </div>
                      <div class="mb-3">
                          <button type="submit" class="btn btn-primary bg-website">
                              Login
                          </button>
                          <a href="{{ route('forget_password') }}" class="primary-color">Forget Password?</a>
                      </div>
                  </form>
                  <div class="mb-3">
                      <a href="{{ route('register') }}" class="primary-color">Don't have an account? Create Account</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection