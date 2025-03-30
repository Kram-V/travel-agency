@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Edit Destination</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_destinations_index') }}">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_destinations_update', $destination->id) }}" method="POST" enctype="multipart/form-data"> 
                                @csrf

                                <img style="width: 130px" src="{{ asset('uploads/destinations/' . $destination->featured_photo) }}" alt="{{ $destination->name }}">

                                <div class="row">
                                  <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">Featured Photo</label>
                                    <input type="file" class="form-control" name="featured_photo">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Name *</label>
                                      <input type="text" class="form-control" name="name" value="{{ $destination->name }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Slug *</label>
                                      <input type="text" class="form-control" name="slug" value="{{ $destination->slug }}">
                                  </div>
                          
                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Country *</label>
                                      <input type="text" class="form-control" name="country" value="{{ $destination->country }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Visa Requirement *</label>
                                    <input type="text" class="form-control" name="visa_requirement" value="{{ $destination->visa_requirement }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Language *</label>
                                    <input type="text" class="form-control" name="language" value="{{ $destination->language }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-4">
                                    <label class="form-label">Activity *</label>
                                    <input type="text" class="form-control" name="activity" value="{{ $destination->activity }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-4">
                                    <label class="form-label">Currency *</label>
                                    <input type="text" class="form-control" name="currency" value="{{ $destination->currency }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-4">
                                    <label class="form-label">Area *</label>
                                    <input type="text" class="form-control" name="area" value="{{ $destination->area }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Timezone *</label>
                                    <input type="text" class="form-control" name="timezone" value="{{ $destination->timezone }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Health and Safety *</label>
                                    <input type="text" class="form-control" name="health_and_safety" value="{{ $destination->health_and_safety }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Best Time *</label>
                                    <input type="text" class="form-control" name="best_time" value="{{ $destination->best_time }}">
                                  </div>

                                  
                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Map * (Iframe Code)</label>
                                    <input type="text" class="form-control" name="map" value="{{ $destination->map }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6 editor-container">
                                    <label class="form-label">Description *</label>
                                    <textarea name="description" class="form-control editor h_100" rows="3">{{ $destination->description }}</textarea>
                                  </div>

                                  <div class="mb-4">
                                      <button type="submit">Update</button>
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