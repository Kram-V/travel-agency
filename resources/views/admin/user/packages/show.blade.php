@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Package Details</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_packages_index') }}" class="btn btn-primary">Back to listing</a>
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
                                <img src="{{ asset("uploads/packages/{$package->featured_photo}") }}" alt="{{ $package->name }}" class="profile-photo w_200">
                              </div>

                              <div class="mb-4 form-group col-md-6">
                                  <label class="form-label">Name</label> <br>
                                  {{ $package->name }}
                              </div>

                              <div class="mb-4 form-group col-md-6">
                                  <label class="form-label">Slug</label> <br>
                                  {{ $package ->slug }}
                              </div>
                      
                              <div class="mb-4 form-group col-md-6">
                                  <label class="form-label">Destination</label> <br>
                                  {{ $package->destination->name }}
                              </div>


                              <div class="mb-4 form-group col-md-6">
                                <label class="form-label">Price</label> <br>
                                {{ $package->price }}
                              </div>

                              <div class="mb-4 form-group col-md-6">
                                <label class="form-label">Old Price</label> <br>
                                {{ $package->old_price }}
                              </div>


                              <div class="mb-4 form-group col-md-6">
                                <label class="form-label">Description</label> <br>
                                {!! $package->description !!}
                              </div>
                              
                              <div class="mb-4 form-group col-md-6">
                                <label class="form-label">Map</label> <br>
                                {!! $package->map !!}
                              </div>

                              <div class="mb-4 form-group col-md-6">
                                <label class="form-label">Gallery</label> <br>
                                <div>
                                  <a href="" class="btn btn-success btn-sm">Photo Gallery</a>
                                  <a href="" class="btn btn-success btn-sm">Video Gallery</a>
                                </div>
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