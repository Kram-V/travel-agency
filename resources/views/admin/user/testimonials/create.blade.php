@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Create Testimonial</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_testimonials_index') }}">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_testimonials_store') }}" method="POST" enctype="multipart/form-data"> 
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
                                      <label class="form-label">Position *</label>
                                      <input type="text" class="form-control" name="position" value="{{ old('position') }}">
                                  </div>
                          
                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Company *</label>
                                      <input type="text" class="form-control" name="company" value="{{ old('company') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Comment *</label>
                                    <textarea name="comment" class="form-control h_100" rows="3">{{ old('comment') }}</textarea>
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