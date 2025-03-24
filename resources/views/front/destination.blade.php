@extends('front.layout.master')

@section('content')
<div class="page-top" style="background-image: url({{ asset('images/banner.jpg') }})">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>Australia</h2>
              <div class="breadcrumb-container">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('destinations') }}">Destinations</a></li>
                      <li class="breadcrumb-item active">{{ $destination->country }}</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
</div>


<div class="destination-detail pt_50 pb_50">
  <div class="container">
      <div class="row">
          <div class="col-lg-12 col-md-12">
              <div class="main-item mb_50">
                  <div class="main-photo">
                      <img src="{{ asset('uploads/destinations/' . $destination->featured_photo) }}" alt="{{ $destination->name }}">
                  </div>
              </div>
              <div class="main-item mb_50">
                  <h2>
                      Description
                  </h2>
                 
                  {!! $destination->description !!}
              </div>


              <div class="main-item mb_50">
                  <h2>Packages</h2>
                  <div class="package">
                      <div class="row">
                        @if (count($packages) > 0)
                          @foreach ($packages as $package)
                            <div class="col-lg-4 col-md-6">
                              <div class="item pb_25">
                                  <div class="photo">
                                      <a href="{{ route('package', $package->slug) }}"><img src="{{ asset('uploads/packages/' . $package->featured_photo) }}" alt="{{ $package->name }}"></a>
                                  </div>
                                  <div class="text">
                                      <div class="price">
                                          ${{ $package->price }} 
                                          @if ($package->old_price)
                                            <del>
                                              ${{ $package->old_price }}
                                            </del>
                                          @endif
                                      </div>
                                      <h2>
                                          <a href="{{ route('package', $package->slug) }}">{{ $package->name }}</a>
                                      </h2>
        
                                      @php
                                        $all_reviews = $package->reviews;
        
                                        $total_ratings = 0;
                                        $average = 0;
        
                                        if (count($all_reviews) > 0) {
                                          foreach ($all_reviews as $review) {
                                            $total_ratings += $review->rating;
                                          }
        
                                          $average = floor($total_ratings / count($package->reviews));
                                        }
                                      @endphp
        
                                      <div class="review">
                                        @for ($i = 1; $i <= 5; $i++)
                                          @if ($i <= $average)
                                            <i class="fas fa-star"></i>
                                          @else
                                            <i class="far fa-star"></i>
                                          @endif
                                        @endfor
                                        ({{ count($all_reviews) }} Reviews)
                                      </div>
                                      <div class="element">
                                          <div class="element-left">
                                              <i class="fas fa-plane-departure"></i> {{ $package->destination->country }}
                                          </div>
                                      </div>
                                      <div class="element">
                                          <div  class="element-left">
                                            @php
                                              $package_tours = $package->package_tours;
        
                                              $total_tours = 0;
        
                                              foreach ($package_tours as $package_tour) {
                                                if ($package_tour->booking_end_date > date('Y-m-d')) {
                                                  $total_tours += 1;
                                                }
                                              }
                                            @endphp
        
                                            <i class="fas fa-globe-asia"></i> {{ $total_tours }} Tours
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                          @endforeach
                        @else
                          <b style="font-size: 30px" class="text-center ">No Package Found</b>
                        @endif
                      </div>
                  </div>
              </div>


              <div class="main-item mb_50">
                  <h2>
                      Information
                  </h2>
                  <div class="summary">
                      <div class="table-responsive">
                          <table class="table table-bordered">
                              <tr>
                                  <td><b>Country</b></td>
                                  <td>{{ $destination->country }}</td>
                              </tr>
                              {{-- <tr>
                                  <td><b>Major Cities</b></td>
                                  <td>
                                      Sydney, Melbourne, Brisbane, Perth, Adelaide, Gold Coast, Canberra, Hobart, Darwin
                                  </td>
                              </tr> --}}
                              <tr>
                                  <td><b>Visa Requirements</b></td>
                                  <td>
                                    {{ $destination->visa_requirement }}
                                  </td>
                              </tr>
                              <tr>
                                  <td><b>Languages Spoken</b></td>
                                  <td>{{ $destination->language }}</td>
                              </tr>
                              <tr>
                                  <td><b>Currency Used</b></td>
                                  <td>{{ $destination->currency }}</td>
                              </tr>
                              <tr>
                                  <td><b>Activities</b></td>
                                  <td>
                                    {{ $destination->activity }}
                                  </td>
                              </tr>
                              <tr>
                                  <td><b>Best Time to Visit</b></td>
                                  <td>
                                    {{ $destination->best_time }}
                                  </td>
                              </tr>
                              <tr>
                                  <td><b>Health and Safety</b></td>
                                  <td>
                                    {{ $destination->health_and_safety }}
                                  </td>
                              </tr>
                              <tr>
                                  <td><b>Area (km2)</b></td>
                                  <td>
                                    {{ $destination->area }}
                                  </td>
                              </tr>
                              <tr>
                                  <td><b>Time Zone</b></td>
                                  <td>
                                    {{ $destination->timezone }}
                                  </td>
                              </tr>
                          </table>
                      </div>
                  </div>
              </div>



              <div class="main-item mb_50">
                  <h2>
                      Photos
                  </h2>
                  <div class="photo-all">
                      <div class="row">
                        @foreach ($destination_photos as $i => $photo)
                        <div class="col-md-6 col-lg-3">
                            <div class="item">
                                <a href="{{ asset('uploads/destination-photos/' . $photo->photo) }}" class="magnific">
                                    <img src="{{ asset('uploads/destination-photos/' . $photo->photo) }}" alt="{{ $photo->destination->name . '-' .  $i + 1}}">
                                </a>
                            </div>
                        </div>
                        @endforeach
                      </div>
                  </div>
              </div>
              <div class="main-item mb_50">
                  <h2>
                      Videos
                  </h2>
                  <div class="video-all">
                      <div class="row">
                        @foreach ($destination_videos as $video)
                        <div class="col-md-6 col-lg-6">
                            <div class="item">
                                <a class="video-button" href="http://www.youtube.com/watch?v={{ $video->video }}">
                                    <img src="http://img.youtube.com/vi/{{ $video->video }}/0.jpg" alt="">
                                    <div class="icon">
                                        <i class="far fa-play-circle"></i>
                                    </div>
                                    <div class="bg"></div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                      </div>
                  </div>
              </div>


              <div class="main-item">
                  <h2>Map</h2>
                  <div class="location-map">
                    {!! $destination->map !!}
                  </div>
              </div>

          </div>
      </div>
  </div>
</div>
@endsection