@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Create Team Member</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_team_members_index') }}">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_team_members_store') }}" method="POST" enctype="multipart/form-data"> 
                                @csrf
                                <div class="row">
                                  <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">Photo</label>
                                    <input type="file" class="form-control" name="photo">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Name *</label>
                                      <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Email Address *</label>
                                      <input type="text" class="form-control" name="email_address" value="{{ old('email_address') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Designation *</label>
                                      <input type="text" class="form-control" name="designation" value="{{ old('designation') }}">
                                  </div>
                          
                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Address *</label>
                                      <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Phone *</label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Facebook Link</label>
                                    <input type="text" class="form-control" name="facebook" value="{{ old('facebook') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Twitter Link</label>
                                    <input type="text" class="form-control" name="twitter" value="{{ old('twitter') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Linkedin Link</label>
                                    <input type="text" class="form-control" name="linkedin" value="{{ old('linkedin') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Instagram Link</label>
                                    <input type="text" class="form-control" name="instagram" value="{{ old('instagram') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6 editor-container">
                                    <label class="form-label">Biography *</label>
                                    <textarea name="biography" class="form-control editor" cols="30" rows="10">{{ old('biography') }}</textarea>
                                  </div>

                                  <div class="mb-4">
                                      <button type="submit">Create</button>
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