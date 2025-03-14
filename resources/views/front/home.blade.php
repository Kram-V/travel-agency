@extends('front.layout.master')

@section('content')

@if (count($sliders) > 0)
  <div class="slider">
    <div class="slide-carousel owl-carousel">
        @foreach ($sliders as $slider)
        <div class="item" style="background-image:url({{ asset('uploads/sliders/' . $slider->background_img) }});">
            <div class="text">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="text-wrapper">
                                <div class="text-content">
                                    <h2>{{ $slider->heading }}</h2>
                                    <p>
                                      {{ $slider->description }}
                                    </p>
                                    @if ($slider->button_link && $slider->button_text)
                                      <div class="button-style-1 mt_20">
                                          <a href="{{ $slider->button_link }}">{{ $slider->button_text }}</a>
                                      </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
  </div>
@endif


<div class="special pt_70 pb_70">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="full-section">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="left-side">
                              <div class="inner">
                                  <h3>{{ $welcome_item->heading }}</h3>
                                  <p>
                                      {{ $welcome_item->description }}
                                  </p>

                                  @if ($welcome_item->button_link && $welcome_item->button_text)
                                    <div class="button-style-1 mt_20">
                                        <a href="{{ $welcome_item->button_link }}">{{ $welcome_item->button_text }}</a>
                                    </div>
                                  @endif
                              </div>
                          </div>
                      </div>
                      
                      <div class="col-md-6">
                          <div class="right-side" style="background-image: url({{ asset('uploads/welcome-item/' . $welcome_item->photo) }});">
                              <a class="video-button" href="https://www.youtube.com/watch?v={{ $welcome_item->video_id }}"><span></span></a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>


<div class="destination pt_70 pb_70">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="heading">
                  <h2>Popular Destinations</h2>
                  <p>
                      Explore our most popular travel destinations around the world
                  </p>
              </div>
          </div>
      </div>
      <div class="row">
        @foreach ($destinations as $destination)
        <div class="col-lg-3 col-md-6">
            <div class="item pb_25">
                <div class="photo">
                    <a href="{{ route('destination', $destination->slug) }}"><img src="{{ asset('uploads/destinations/' . $destination->featured_photo) }}" alt=""></a>
                </div>
                <div class="text">
                    <h2>
                        <a href="{{ route('destination', $destination->slug) }}">Australia</a>
                    </h2>
                </div>
            </div>
        </div>
        @endforeach
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="see-more">
                  <div class="button-style-1 mt_20">
                      <a href="{{ route('destinations') }}">View All Destinations</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

@if (count($features) > 0)
  <div class="why-choose pt_70">
    <div class="container">
        <div class="row">
          @foreach ($features as $feature)
            <div class="col-md-4">
                <div class="inner pb_70">
                    <div class="icon">
                        <i class="{{ $feature->icon }}"></i>
                    </div>
                    <div class="text">
                        <h2>{{ $feature->heading }}</h2>
                        <p>
                            {{ $feature->description }}
                        </p>
                    </div>
                </div>
            </div>
          @endforeach
        </div>
    </div>
  </div>
@endif

<div class="package pt_70 pb_70">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="heading">
                  <h2>Popular Packages</h2>
                  <p>
                      Explore our most popular travel packages around the world
                  </p>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-lg-4 col-md-6">
              <div class="item pb_25">
                  <div class="photo">
                      <a href="package.html"><img src="images/package-1.jpg" alt=""></a>
                      <div class="wishlist">
                          <a href=""><i class="far fa-heart"></i></a>
                      </div>
                  </div>
                  <div class="text">
                      <div class="price">
                          $150 <del>$250</del>
                      </div>
                      <h2>
                          <a href="package.html">Venice Grand Canal</a>
                      </h2>
                      <div class="review">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          (4 Reviews)
                      </div>
                      <div class="element">
                          <div class="element-left">
                              <i class="fas fa-plane-departure"></i> Italy
                          </div>
                          <div class="element-right">
                              <i class="fas fa-calendar-alt date-icon"></i> 14 Jun, 2024
                          </div>
                      </div>
                      <div class="element">
                          <div class="element-left">
                              <i class="fas fa-users"></i> 25 Persons
                          </div>
                          <div class="element-right">
                              <i class="fas fa-clock"></i> 7 Days
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6">
              <div class="item pb_25">
                  <div class="photo">
                      <a href="package.html"><img src="images/package-2.jpg" alt=""></a>
                      <div class="wishlist">
                          <a href=""><i class="far fa-heart"></i></a>
                      </div>
                  </div>
                  <div class="text">
                      <div class="price">
                          $230
                      </div>
                      <h2>
                          <a href="package.html">Great Barrier Reef</a>
                      </h2>
                      <div class="review">
                          <i class="far fa-star"></i>
                          <i class="far fa-star"></i>
                          <i class="far fa-star"></i>
                          <i class="far fa-star"></i>
                          <i class="far fa-star"></i>
                          (0 Reviews)
                      </div>
                      <div class="element">
                          <div class="element-left">
                              <i class="fas fa-plane-departure"></i> Australia
                          </div>
                          <div class="element-right">
                              <i class="fas fa-calendar-alt date-icon"></i> 23 Sep, 2024
                          </div>
                      </div>
                      <div class="element">
                          <div class="element-left">
                              <i class="fas fa-users"></i> 12 Persons
                          </div>
                          <div class="element-right">
                              <i class="fas fa-clock"></i> 3 Days
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6">
              <div class="item pb_25">
                  <div class="photo">
                      <a href="package.html"><img src="images/package-3.jpg" alt=""></a>
                      <div class="wishlist">
                          <a href=""><i class="far fa-heart"></i></a>
                      </div>
                  </div>
                  <div class="text">
                      <div class="price">
                          $540
                      </div>
                      <h2>
                          <a href="package.html">Similan Islands, Andaman Sea</a>
                      </h2>
                      <div class="review">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="far fa-star"></i>
                          (34 Reviews)
                      </div>
                      <div class="element">
                          <div class="element-left">
                              <i class="fas fa-plane-departure"></i> Thailand
                          </div>
                          <div class="element-right">
                              <i class="fas fa-calendar-alt date-icon"></i> 20 Jul, 2024
                          </div>
                      </div>
                      <div class="element">
                          <div class="element-left">
                              <i class="fas fa-users"></i> 22 Persons
                          </div>
                          <div class="element-right">
                              <i class="fas fa-clock"></i> 5 Days
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="see-more">
                  <div class="button-style-1 mt_20">
                      <a href="packages.html">View All Packages</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>




<div class="testimonial pt_70 pb_70" style="background-image: url(images/testimonial-bg.jpg)">
  <div class="bg"></div>
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2 class="main-header">Client Testimonials</h2>
              <h3 class="sub-header">
                  See what our clients have to say about their experience with us
              </h3>
          </div>
      </div>
      <div class="row">
          <div class="col-12">
              <div class="testimonial-carousel owl-carousel">
                @foreach ($testimonials as $testimonial)
                <div class="item">
                    <div class="photo">
                      @if (!$testimonial->photo)
                        <img src="{{ asset('images/default.png') }}" alt="Default">
                      @else
                        <img src="{{ asset('uploads/testimonials/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" />
                      @endif
                    </div>
                    <div class="text">
                        <h4>{{ $testimonial->name }}</h4>
                        <p>{{ $testimonial->position }}, {{ $testimonial->company }}</p>
                    </div>
                    <div class="quote">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="description">
                        <p>
                          {{ $testimonial->comment }}
                        </p>
                    </div>
                </div>
                @endforeach
              </div>
          </div>
      </div>
  </div>
</div>



<div class="blog pt_70">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="heading">
                  <h2>Latest News</h2>
                  <p>
                      Check out the latest news and updates from our blog post
                  </p>
              </div>
          </div>
      </div>
      <div class="row">
        @foreach ($blog_posts as $post)
          <div class="col-lg-4 col-md-6">
              <div class="item pb_70">
                  <div class="photo">
                      <img src="{{ asset('uploads/blog-posts/' . $post->photo) }}" alt="{{ $post->title }}" />
                  </div>
                  <div class="text">
                      <h2>
                          <a href="post.html">{{ $post->title }}</a>
                      </h2>
                      <div class="short-des">
                          <p>
                            {{ $post->short_description }}
                          </p>
                      </div>
                      <div class="button-style-2 mt_20">
                          <a href="post.html">Read More</a>
                      </div>
                  </div>
              </div>
          </div>
        @endforeach
      </div>
  </div>
</div>
@endsection


