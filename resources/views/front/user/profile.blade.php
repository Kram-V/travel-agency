@extends('front.layout.master')

@section('content')
<div class="page-top" style="background-image: url('images/banner.jpg')">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>Profile</h2>
          </div>
      </div>
  </div>
</div>

<div class="page-content user-panel pt_70 pb_70">
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-3 col-md-12">
              <div class="card">
                @include('front.user.sidebar')
              </div>
          </div>
          <div class="col-lg-9 col-md-12">
            <div class="profile-container">
              <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row"> 
                      <div class="col-md-12 mb-3">
                          @if (!$user->photo)
                            <img style="border-radius: 100%" src="{{ asset('images/default.png') }}" alt="Default" class="user-photo">
                          @else
                            <img style="border-radius: 100%" src="{{ asset('uploads/user/' . $user->photo )}}" alt="Default" class="user-photo">
                          @endif
                      </div>
                      <div class="col-md-12 mb-3">
                          <label for="">Change Photo</label>
                          <div class="form-group">
                              <input type="file" name="photo">
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="">Name *</label>
                          <div class="form-group">
                              <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="">Email Address *</label>
                          <div class="form-group">
                              <input style="cursor: not-allowed;" type="text" name="email" class="form-control"  value="{{ $user->email }}" readonly>
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="">Phone *</label>
                          <div class="form-group">
                              <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="">Country *</label>
                          <div class="form-group">
                              <input type="text" name="country" class="form-control" value="{{ $user->country }}">
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="">Address *</label>
                          <div class="form-group">
                              <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="">State *</label>
                          <div class="form-group">
                              <input type="text" name="state" class="form-control" value="{{ $user->state }}">
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="">City *</label>
                          <div class="form-group">
                              <input type="text" name="city" class="form-control" value="{{ $user->city }}">
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="">Zip Code *</label>
                          <div class="form-group">
                              <input type="text" name="zip" class="form-control" value="{{ $user->zip }}">
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="">Password</label>
                          <div class="form-group">
                              <input type="password" name="password" class="form-control">
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="">Confirm Password</label>
                          <div class="form-group">
                              <input type="password" name="confirm_password" class="form-control">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <input name="form_update" type="submit" class="btn btn-submit" value="Update">
                          </div>
                      </div>
                  </div>
              </form>
            </div>
          </div>
      </div>
  </div>
</div>
@endsection