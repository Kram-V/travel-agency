@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Create Blog Post</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_blog_posts_index') }}" >Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_blog_posts_store') }}" method="POST" enctype="multipart/form-data"> 
                                @csrf
                                <div class="row">
                                  <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">Photo *</label>
                                    <input type="file" class="form-control" name="photo">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Title *</label>
                                      <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Category *</label>
                                    <select name="category" class="form-control">
                                      <option value="">Select Category</option>
                                      @foreach ($blog_categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                      @endforeach
                                    </select>
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Slug *</label>
                                      <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                                  </div>
                          
                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Short Description *</label>
                                      <input type="text" class="form-control" name="short_description" value="{{ old('short_description') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6 editor-container">
                                    <label class="form-label">Description *</label>
                                    <textarea name="description" class="form-control editor h_100" rows="3">{{ old('description') }}</textarea>
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