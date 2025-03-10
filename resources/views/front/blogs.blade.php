@extends('front.layout.master')

@section('content')

<div class="page-top" style="background-image: url('images/banner.jpg')">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>Blogs</h2>
              <div class="breadcrumb-container">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                      <li class="breadcrumb-item active">Blogs</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="blog pt_70 pb_70">
  <div class="container">
      <div class="row">
        @foreach ($blog_posts as $post)
        <div class="col-lg-4 col-md-6">
            <div class="item pb_70">
                <div class="photo">
                    <img src="{{ asset('uploads/blog-posts/' . $post->photo) }}" alt="{{ $post->title }}" />
                </div>
                <div class="text">
                    <h2>
                        <a href="{{ route('blog', $post->slug) }}">{{ $post->title }}</a>
                    </h2>
                    <div class="short-des">
                        <p>
                          {{ $post->short_description }}
                        </p>
                    </div>
                    <div class="button-style-2 mt_20">
                        <a href="{{ route('blog', $post->slug) }}">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
      </div>
  </div>
</div>

<div class="container pb_50">
  <div class="row">
    <div class="col-md-12">
      {{ $blog_posts->links() }}
    </div>
  </div>
</div>
@endsection