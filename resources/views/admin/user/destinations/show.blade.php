@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Destination Details</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_destinations_index') }}" class="btn btn-primary">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <div class="row g-4">
                              <div class="mb-3 form-group col-md-6">
                                <label class="form-label">Featured Photo</label> <br>
                                <img src="{{ asset("uploads/destinations/{$destination->featured_photo}") }}" alt="{{ $destination->name }}" class="profile-photo w_200">
                              </div>

                              <div class="mb-4 form-group col-md-6">
                                  <label class="form-label">Name</label> <br>
                                  {{ $destination->name }}
                              </div>

                              <div class="mb-4 form-group col-md-6">
                                  <label class="form-label">Slug</label> <br>
                                  {{ $destination->slug }}
                              </div>
                      
                              <div class="mb-4 form-group col-md-6">
                                  <label class="form-label">Country</label> <br>
                                  {{ $destination->country }}
                              </div>

                              <div class="mb-4 form-group col-md-6">
                                <label class="form-label">Visa Requirement</label> <br>
                                {{ $destination->visa_requirement }}
                              </div>

                              <div class="mb-4 form-group col-md-6">
                                <label class="form-label">Language</label> <br>
                                {{ $destination->language }}
                              </div>

                              <div class="mb-4 form-group col-md-6">
                                <label class="form-label">Currency</label> <br>
                                {{ $destination->currency }}
                              </div>

                              <div class="mb-4 form-group col-md-6">
                                <label class="form-label">Area</label> <br>
                                {{ $destination->area }}
                              </div>

                              <div class="mb-4 form-group col-md-6">
                                <label class="form-label">Timezone</label> <br>
                                {{ $destination->timezone }}
                              </div>

                              <div class="mb-4 form-group col-md-6">
                                <label class="form-label">Health and Safety</label> <br>
                                {{ $destination->health_and_safety }}
                              </div>

                              <div class="mb-4 form-group col-md-6">
                                <label class="form-label">Best Time</label> <br>
                                {{ $destination->best_time }}
                              </div>

                              
                              <div class="mb-4 form-group col-md-6">
                                <label class="form-label">Map</label> <br>
                                {!! $destination->map !!}
                              </div>

                              <div class="mb-4 form-group col-md-6">
                                <label class="form-label">Description</label> <br>
                                {!! $destination->description !!}
                              </div>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </div>
@endsection