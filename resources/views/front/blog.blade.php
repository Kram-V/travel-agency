@extends('front.layout.master')

@section('content')
<div class="page-top" style="background-image: url({{ asset('uploads/blog-posts/' . $blog_post->photo) }})">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>{{ $blog_post->title }}</h2>
              <div class="breadcrumb-container">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('blogs') }}">Blogs</a></li>
                      <li class="breadcrumb-item active">{{ $blog_post->title }}</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="post pt_50 pb_50">
  <div class="container">
      <div class="row">
          <div class="col-lg-8 col-md-12">
              <div class="left-item">
                  <div class="main-photo">
                      <img src="{{ asset('uploads/blog-posts/' . $blog_post->photo) }}" alt="{{ $blog_post->title }}">
                  </div>
                  <div class="sub">
                      <ul>
                          <li><i class="fas fa-calendar-alt"></i> On: {{ $blog_post->created_at->format('m-d-Y'); }}</li>
                          <li><i class="fas fa-th-large"></i> Category: <a href="{{ route('blog_category', $blog_post->blog_category->slug) }}">{{ $blog_post->blog_category->name }}</a></li>
                      </ul>
                  </div>
                  <div class="description">
                    {!! $blog_post->description !!}
                  </div>
              </div>
          </div>
          
          <div class="col-lg-4 col-md-12">
              <div class="right-item">
                  <h2>Latest Posts</h2>
                  <ul>
                    @foreach ($latest_blog_posts as  $latest_blog_post)
                      <li><a href="{{ route('blog', $latest_blog_post->slug) }}" class="{{ $blog_post->title === $latest_blog_post->title ? 'active' : '' }}"><i class="fas fa-angle-right"></i> {{ $latest_blog_post->title }}</a></li>
                    @endforeach
                  </ul>

                  <h2 class="mt_40">Categories</h2>
                  <ul>
                    @foreach ($categories as $category)
                      <li><a href="{{ route('blog_category', $category->slug) }}" class="{{ $category->name === $blog_post->blog_category->name ? 'active' : '' }}"><i class="fas fa-angle-right"></i> {{ $category->name }}</a></li>
                    @endforeach
                  </ul>

              </div>
          </div>
      </div>
  </div>
</div>
@endsection