@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Create Blog Category</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_blog_categories_index') }}" class="btn btn-primary">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_blog_categories_create') }}" method="POST"> 
                                @csrf
                                <div class="row">
                                  <div class="mb-4 form-group col-md-12">
                                    <label class="form-label">Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-12">
                                    <label class="form-label">Slug *</label>
                                    <textarea name="slug" class="form-control h_100" rows="3">{{ old('slug') }}</textarea>
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