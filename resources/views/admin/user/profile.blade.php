@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header">
              <h1>Edit Profile</h1>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-body">
                              <form action="{{ route('admin_profile_submit') }}" method="POST" enctype="multipart/form-data"> 
                                  @csrf
                                  <div class="row">
                                      <div class="col-md-3">
                                          @if (!$admin_user->photo)
                                            <img src="{{ asset('images/default.png') }}" alt="Default" class="profile-photo w_100_p">
                                          @else
                                            <img src="{{ asset("uploads/admin/{$admin_user->photo}") }}" alt="" class="profile-photo w_100_p">
                                          @endif
                                    
                                          <input type="file" class="mt_10" name="photo">
                                      </div>
                                      <div class="col-md-9">
                                          <div class="mb-4">
                                              <label class="form-label">Name *</label>
                                              <input type="text" class="form-control" name="name" value="{{ $admin_user->name }}">
                                          </div>
                                          <div class="mb-4">
                                              <label class="form-label">Email *</label>
                                              <input style="cursor: not-allowed;" type="text" class="form-control" name="email" value="{{ $admin_user->email }}" readonly>
                                          </div>
                                          <div class="mb-4">
                                              <label class="form-label">New Password</label>
                                              <input type="password" class="form-control" name="password">
                                          </div>
                                          <div class="mb-4">
                                              <label class="form-label">Confirm Password</label>
                                              <input type="password" class="form-control" name="confirm_password">
                                          </div>
                                          <div class="mb-4">
                                              <label class="form-label"></label>
                                              <button type="submit" class="btn btn-primary">Update</button>
                                          </div>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </div>
@endsection
