@extends('front.layout.master')

@section('content')
<div class="page-top" style="background-image: url({{ asset('images/banner.jpg') }})">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>{{ $blog_category->name }}</h2>
          </div>
      </div>
  </div>
</div>

<div class="blog pt_70">
  <div class="container">
      <div class="row">
        @foreach ($blog_posts as $blog_post)
        <div class="col-lg-4 col-md-6">
            <div class="item pb_70">
                <div class="photo">
                    <img src="{{ asset('uploads/blog-posts/' . $blog_post->photo) }}" alt="{{ $blog_post->title }}" />
                </div>
                <div class="text">
                    <h2>
                        <a href="{{ route('blog', $blog_post->slug) }}">{{ $blog_post->title }}</a>
                    </h2>
                    <div class="short-des">
                        <p>
                          {{ $blog_post->short_description }}
                        </p>
                    </div>
                    <div class="button-style-2 mt_20">
                        <a href="{{ route('blog', $blog_post->slug) }}">Read More <i class="fas fa-long-arrow-alt-right"></i></a>
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