@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Edit Package</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_packages_index') }}">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_packages_update', $package->id) }}" method="POST" enctype="multipart/form-data"> 
                                @csrf

                                <img style="width: 130px" src="{{ asset('uploads/packages/' . $package->featured_photo) }}" alt="{{ $package->name }}">

                                <div class="row">
                                  <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">Featured Photo</label>
                                    <input type="file" class="form-control" name="featured_photo">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Name *</label>
                                      <input type="text" class="form-control" name="name" value="{{ $package->name }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Slug *</label>
                                      <input type="text" class="form-control" name="slug" value="{{ $package->slug }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Destination *</label>
                                    <select name="destination" class="form-control">
                                      <option value="">Select Destination</option>
                                      @foreach ($destinations as $destination)
                                        <option value="{{ $destination->id }}" {{ $destination->id ==  $package->destination_id ? 'selected' : '' }}>{{ $destination->name }}</option>
                                      @endforeach
                                    </select> 
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Price *</label>
                                    <input type="text" class="form-control" name="price" value="{{ $package->price }}">
                                  </div>


                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Old Price</label>
                                    <input type="text" class="form-control" name="old_price" value="{{ $package->old_price }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Map * (Iframe Code)</label>
                                    <textarea name="map" class="form-control h_300" rows="3">{{ $package->map }}</textarea>
                                  </div>

                                  <div class="mb-4 form-group col-md-6 editor-container">
                                    <label class="form-label">Description *</label>
                                    <textarea name="description" class="form-control editor h_100" rows="3">{{ $package->description }}</textarea>
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