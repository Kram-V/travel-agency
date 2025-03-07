@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Edit Team Member</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_team_members_index') }}" class="btn btn-primary">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_team_members_update', $team_member->id) }}" method="POST" enctype="multipart/form-data"> 
                                @csrf
    
                                @if (!$team_member->photo)
                                  <img src="{{ asset('images/default.png') }}" alt="Default" class="profile-photo w_100">
                                @else
                                  <img style="width: 130px" src="{{ asset('uploads/team-members/' . $team_member->photo) }}" alt="{{ $team_member->name }}">
                                @endif
                              
                                <div class="row">
                                  <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">Photo</label>
                                    <input type="file" class="form-control" name="photo">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Name *</label>
                                      <input type="text" class="form-control" name="name" value="{{ $team_member->name }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Email Address *</label>
                                    <input type="text" class="form-control" name="email_address" value="{{ $team_member->email_address }}">
                                  </div>


                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Designation *</label>
                                      <input type="text" class="form-control" name="designation" value="{{ $team_member->designation }}">
                                  </div>
                          
                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Address *</label>
                                      <input type="text" class="form-control" name="address" value="{{ $team_member->address }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Phone *</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $team_member->phone }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Facebook Link</label>
                                    <input type="text" class="form-control" name="facebook" value="{{ $team_member->facebook }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Twitter Link</label>
                                    <input type="text" class="form-control" name="twitter" value="{{ $team_member->twitter }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Linkedin Link</label>
                                    <input type="text" class="form-control" name="linkedin" value="{{ $team_member->linkedin }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Instagram Link</label>
                                    <input type="text" class="form-control" name="instagram" value="{{ $team_member->instagram }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Biography *</label>
                                    <textarea name="biography" class="form-control editor" cols="30" rows="10">{{ $team_member->biography }}</textarea>
                                  </div>

                                  <div class="mb-4">
                                      <button type="submit" class="btn btn-primary">Update</button>
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