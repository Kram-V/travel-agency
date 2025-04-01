@extends('front.layout.master')

@section('content')
<div class="page-top" style="background-image: url({{ asset('images/banner.jpg') }})">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>Packages</h2>
          </div>
      </div>
  </div>
</div>

<div class="package pt_70 pb_50">
  <div class="container">
      <div class="row">
          <div class="col-lg-4 col-md-6">
            <form action="{{ route('packages') }}" method="GET">
              <div class="package-sidebar">
                  <div class="widget">
                      <h2>Search Package</h2>
                      <div class="box">
                          <div class="row">
                              <div class="col-md-12">
                                  <input type="text" name="package_name" class="form-control" placeholder="Package Name ..." value="{{ $_GET['package_name'] ?? '' }}">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="widget">
                      <h2>Filter by Price</h2>
                      <div class="box">
                          <div class="row">
                              <div class="col-md-6">
                                  <input type="number" name="min_price" class="form-control" placeholder="Min" value="{{ !isset($_GET['min_price']) || $_GET['min_price'] == ''  ? '0' : $_GET['min_price'] }}">
                              </div>
                              <div class="col-md-6">
                                  <input type="number" name="max_price" class="form-control" placeholder="Max" value="{{ !isset($_GET['max_price']) || $_GET['max_price'] == '' ? '0' : $_GET['max_price'] }}">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="widget">
                      <h2>Filter by Destination</h2>
                      <div class="box">
                        <select name="destination_id" class="form-select">
                          <option value="">All</option>
                          @foreach ($destinations as $destination)
                            <option value="{{ $destination->id }}" {{ isset($_GET['destination_id']) && $_GET['destination_id'] == $destination->id ? 'selected' : '' }}>{{ $destination->country }}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                  <div class="widget">
                      <h2>Filter by Review</h2>
                      <div class="box">
                          <div class="form-check form-check-review form-check-review-1">
                              <input name="review" class="form-check-input" type="radio" name="reviewRadios" id="reviewRadiosAll" value="all" {{ !isset($_GET['review']) ||  (isset($_GET['review']) && $_GET['review'] == 'all') ? 'checked' : '' }}>
                              <label class="form-check-label" for="reviewRadiosAll">
                                  All
                              </label>
                          </div>
                          <div class="form-check form-check-review">
                              <input name="review" class="form-check-input" type="radio" name="reviewRadios" id="reviewRadios1" value="5"  {{ isset($_GET['review']) && $_GET['review'] == '5' ? 'checked' : '' }}>
                              <label class="form-check-label" for="reviewRadios1">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                              </label>
                          </div>
                          <div class="form-check form-check-review">
                              <input name="review" class="form-check-input" type="radio" name="reviewRadios" id="reviewRadios2" value="4"  {{ isset($_GET['review']) && $_GET['review'] == '4' ? 'checked' : '' }}>
                              <label class="form-check-label" for="reviewRadios2">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                              </label>
                          </div>
                          <div class="form-check form-check-review">
                              <input name="review" class="form-check-input" type="radio" name="reviewRadios" id="reviewRadios3" value="3"  {{ isset($_GET['review']) && $_GET['review'] == '3' ? 'checked' : '' }}>
                              <label class="form-check-label" for="reviewRadios3">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                              </label>
                          </div>
                          <div class="form-check form-check-review">
                              <input name="review" class="form-check-input" type="radio" name="reviewRadios" id="reviewRadios4" value="2"  {{ isset($_GET['review']) && $_GET['review'] == '2' ? 'checked' : '' }}>
                              <label class="form-check-label" for="reviewRadios4">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                              </label>
                          </div>
                          <div class="form-check form-check-review">
                              <input name="review" class="form-check-input" type="radio" name="reviewRadios" id="reviewRadios5" value="1"  {{ isset($_GET['review']) && $_GET['review'] == '1' ? 'checked' : '' }}>
                              <label class="form-check-label" for="reviewRadios5">
                                  <i class="fas fa-star"></i>
                              </label>
                          </div>
                      </div>
                  </div>
                  <div class="filter-button">
                      <button class="btn">Filter</button>
                  </div>
              </div>
            </form>
          </div>

          <div class="col-lg-8 col-md-6">
              <div class="row">
                @if (count($packages) > 0)
                  @foreach ($packages as $package) 
                    <div class="col-lg-6 col-md-6">
                      <div class="item pb_25">
                          <div class="photo">
                              <a href="{{ route('package', $package->slug) }}" target="_blank"><img src="{{ asset('uploads/packages/' . $package->featured_photo) }}" alt="{{ $package->name }}"></a>
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
                                  <a href="{{ route('package', $package->slug) }}" target="_blank">{{ $package->name }}</a>
                              </h2>

                              @php
                                $all_reviews = $package->reviews; 
                              @endphp

                              <div class="review">
                                @for ($i = 1; $i <= 5; $i++)
                                  @if ($i <= round($package->average_rating))
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

              <div class="row">
                <div class="col-md-12">
                  {{ $packages->appends($_GET)->links() }}
                </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection