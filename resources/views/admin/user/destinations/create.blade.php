@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Create Destination</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_destinations_index') }}" class="btn btn-primary">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_destinations_store') }}" method="POST" enctype="multipart/form-data"> 
                                @csrf
                                <div class="row">
                                  <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">Featured Photo *</label>
                                    <input type="file" class="form-control" name="featured_photo">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Name *</label>
                                      <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Slug *</label>
                                      <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                                  </div>
                          
                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Country *</label>
                                      <input type="text" class="form-control" name="country" value="{{ old('country') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Visa Requirement *</label>
                                    <input type="text" class="form-control" name="visa_requirement" value="{{ old('visa_requirement') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Language *</label>
                                    <input type="text" class="form-control" name="language" value="{{ old('language') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-4">
                                    <label class="form-label">Activity *</label>
                                    <input type="text" class="form-control" name="activity" value="{{ old('activity') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-4">
                                    <label class="form-label">Currency *</label>
                                    <input type="text" class="form-control" name="currency" value="{{ old('currency') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-4">
                                    <label class="form-label">Area *</label>
                                    <input type="text" class="form-control" name="area" value="{{ old('area') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-4">
                                    <label class="form-label">Timezone *</label>
                                    <input type="text" class="form-control" name="timezone" value="{{ old('timezone') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-4">
                                    <label class="form-label">Health and Safety *</label>
                                    <input type="text" class="form-control" name="health_and_safety" value="{{ old('health_and_safety') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-4">
                                    <label class="form-label">Best Time *</label>
                                    <input type="text" class="form-control" name="best_time" value="{{ old('best_time') }}">
                                  </div>

                                  
                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Map * (Iframe Code)</label>
                                    <textarea name="map" class="form-control editor h_100" rows="3">{{ old('map') }}</textarea>
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Description *</label>
                                    <textarea name="description" class="form-control editor h_100" rows="3">{{ old('description') }}</textarea>
                                  </div>

                                  <div class="mb-4">
                                      <button type="submit" class="btn btn-primary">Create</button>
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