@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Edit Feature</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_features_index') }}">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_features_update', $feature->id) }}" method="POST"> 
                                @csrf
                                @method('PUT') 

                                <div class="row">
                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Icon * (Use fontawesome version 5) <a href="https://fontawesome.com/v5/search" target="_blank">Find Here</a></label>
                                      <input type="text" class="form-control" name="icon" value="{{ $feature->icon }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Heading *</label>
                                      <input type="text" class="form-control" name="heading" value="{{ $feature->heading }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Description *</label>
                                    <textarea name="description" class="form-control h_100" rows="3">{{ $feature->description }}</textarea>
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