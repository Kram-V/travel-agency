@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Edit Blog Post</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_blog_posts_index') }}" class="btn btn-primary">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_blog_posts_update', $blog_post->id) }}" method="POST" enctype="multipart/form-data"> 
                                @csrf
                                <img src="{{ asset("uploads/blog-posts/{$blog_post->photo}") }}" alt="{{ $blog_post->name }}" class="profile-photo w_150">
                                <div class="row">
                                  <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">Photo</label>
                                    <input type="file" class="form-control" name="photo">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Title *</label>
                                      <input type="text" class="form-control" name="title" value="{{ $blog_post->title }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Category *</label>
                                    <select name="category" class="form-control">
                                      <option value="">Select Category</option>
                                      @foreach ($blog_categories as $category)
                                        <option value="{{ $category->id }}" {{ $blog_post->blog_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                      @endforeach
                                    </select>
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Slug *</label>
                                      <input type="text" class="form-control" name="slug" value="{{ $blog_post->slug }}">
                                  </div>
                          
                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Short Description *</label>
                                      <input type="text" class="form-control" name="short_description" value="{{ $blog_post->short_description }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Description *</label>
                                    <textarea name="description" class="form-control editor h_100" rows="3">{{ $blog_post->description }}</textarea>
                                  </div>

                                  <div class="mb-4">
                                      <button type="submit" class="btn btn-primary">Update</button>
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