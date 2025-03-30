@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Create Slider</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_sliders_index') }}">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_sliders_store') }}" method="POST" enctype="multipart/form-data"> 
                                @csrf
                                <div class="row">
                                  <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">Background Image *</label>
                                    <input type="file" class="form-control" name="background_img">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Heading *</label>
                                      <input type="text" class="form-control" name="heading" value="{{ old('heading') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Button Text</label>
                                      <input type="text" class="form-control" name="button_text" value="{{ old('button_text') }}">
                                  </div>
                          
                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Button Link</label>
                                      <input type="text" class="form-control" name="button_link" value="{{ old('button_link') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Description *</label>
                                    <textarea name="description" class="form-control h_100" rows="3">{{ old('description') }}</textarea>
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