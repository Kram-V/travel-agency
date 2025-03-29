@extends('front.layout.master')

@section('content')
<div class="page-top page-top-package" style="background-image: url({{ asset('uploads/packages/' . $package->featured_photo) }})">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>{{ $package->name  }}</h2>
              <h3><i class="fas fa-plane-departure"></i> {{ $package->destination->country  }}</h3>
              <div class="review">
                  <div class="set">
                    @for ($i = 1; $i <= 5; $i++)
                      @if ($i <= round($package->average_rating))
                        <i class="fas fa-star"></i>
                      @else
                        <i class="far fa-star"></i>
                      @endif
                    @endfor
                  </div>
                  <span>({{ $package->average_rating }} out of 5)</span>
              </div>
              <div class="price">
                  ${{ $package->price  }} 
                  @if (!empty($package->old_price))
                    <del>${{ $package->old_price  }}</del>
                  @endif
              </div>
              <div class="person">
                  per person
              </div>
          </div>
      </div>
  </div>
</div>


<div class="package-detail pt_50 pb_50">
  <div class="container">
      <div class="row">
          <div class="col-lg-12 col-md-12">


              <div class="main-item mb_50">
                  <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="tab-1" data-bs-toggle="tab" data-bs-target="#tab-1-pane" type="button" role="tab" aria-controls="tab-1-pane" aria-selected="true">Details</button>
                      </li>
                      {{-- <li class="nav-item" role="presentation">
                          <button class="nav-link" id="tab-2" data-bs-toggle="tab" data-bs-target="#tab-2-pane" type="button" role="tab" aria-controls="tab-2-pane" aria-selected="false">Tour Plan</button>
                      </li> --}}
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="tab-3" data-bs-toggle="tab" data-bs-target="#tab-3-pane" type="button" role="tab" aria-controls="tab-3-pane" aria-selected="false">Location</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="tab-4" data-bs-toggle="tab" data-bs-target="#tab-4-pane" type="button" role="tab" aria-controls="tab-4-pane" aria-selected="false">Gallery</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="tab-5" data-bs-toggle="tab" data-bs-target="#tab-5-pane" type="button" role="tab" aria-controls="tab-5-pane" aria-selected="false">FAQ</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="tab-6" data-bs-toggle="tab" data-bs-target="#tab-6-pane" type="button" role="tab" aria-controls="tab-6-pane" aria-selected="false">Review</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="tab-7" data-bs-toggle="tab" data-bs-target="#tab-7-pane" type="button" role="tab" aria-controls="tab-7-pane" aria-selected="false">Inquiry</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="tab-8" data-bs-toggle="tab" data-bs-target="#tab-8-pane" type="button" role="tab" aria-controls="tab-8-pane" aria-selected="false">Booking</button>
                      </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                      
                      <div class="tab-pane fade show active" id="tab-1-pane" role="tabpanel" aria-labelledby="tab-1" tabindex="0">
                          <!-- Detail -->
                          <h2 class="mt_30">Details</h2>

                          {!! $package->description !!}

                          <h2 class="mt_30">Includes</h2>
                          <div class="amenity">
                              <div class="row">
                                @if (count($package_amenities_included) > 0)
                                  @foreach ($package_amenities_included as $included)
                                  <div class="col-lg-3 mb_15">
                                      <i class="fas fa-check"></i> {{ $included->amenity->name }}
                                  </div>
                                  @endforeach
                                @else
                                  <b>No Included Amenities</b>
                                @endif
                             
                              </div>
                          </div>

                          <h2 class="mt_30">Excludes</h2>
                          <div class="amenity">
                              <div class="row">
                                @if (count($package_amenities_excluded) > 0)
                                  @foreach ($package_amenities_excluded as $excluded)
                                  <div class="col-lg-3 mb_15">
                                      <i class="fas fa-times"></i> {{ $excluded->amenity->name }}
                                  </div>
                                  @endforeach
                                @else
                                  <b>No Excluded Amenities</b>
                                @endif
                              </div>
                          </div>
                          <!-- // Detail -->

                          
                      </div>

                      {{-- <div class="tab-pane fade" id="tab-2-pane" role="tabpanel" aria-labelledby="tab-2" tabindex="0">
                          <h2 class="mt_30">Tour Plan</h2>
                          <div class="tour-plan">
                              @if (count($package_iteneraries) > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                      @foreach ($package_iteneraries as $package_itenerary)
                                      <tr>
                                          <td><b>{{ $package_itenerary->name }}</b></td>
                                          <td>
                                              {!! $package_itenerary->description !!}
                                          </td>
                                      </tr>
                                      @endforeach
                                    </table>
                                </div>
                              @else
                                <b>No Tour Plans</b>
                              @endif
                          </div>

                          <!-- // Tour Plan -->
                      </div> --}}

                      <div class="tab-pane fade" id="tab-3-pane" role="tabpanel" aria-labelledby="tab-3" tabindex="0">
                          <!-- Location -->
                          <h2 class="mt_30">Location Map</h2>
                          <div class="location-map">
                            {!! $package->map !!}
                          </div>
                          <!-- // Location -->
                      </div>

                      <div class="tab-pane fade" id="tab-4-pane" role="tabpanel" aria-labelledby="tab-4" tabindex="0">
                          <!-- Gallery -->
                          <h2 class="mt_30">
                              Photos
                          </h2>
                          <div class="photo-all">
                              <div class="row">
                                @if (count($package_photos) > 0)
                                  @foreach ($package_photos as $package_photo)
                                  <div class="col-md-6 col-lg-3">
                                      <div class="item">
                                          <a href="{{ asset('uploads/package-photos/' . $package_photo->photo) }}" class="magnific">
                                              <img src="{{ asset('uploads/package-photos/' . $package_photo->photo) }}" alt="">
                                          </a>
                                      </div>
                                  </div>
                                  @endforeach
                                @else
                                  <b>No Photos</b>
                                @endif
                              </div>
                          </div>


                          <h2 class="mt_30">
                              Videos
                          </h2>
                          <div class="video-all">
                              <div class="row">
                                @if (count($package_videos) > 0)
                                  @foreach ($package_videos as $package_video)
                                  <div class="col-md-6 col-lg-6">
                                      <div class="item">
                                          <a class="video-button" href="http://www.youtube.com/watch?v={{ $package_video->video }}">
                                              <img src="http://img.youtube.com/vi/{{ $package_video->video }}/0.jpg" alt="">
                                              <div class="icon">
                                                  <i class="far fa-play-circle"></i>
                                              </div>
                                              <div class="bg"></div>
                                          </a>
                                      </div>
                                  </div>       
                                  @endforeach
                                @else
                                <b>No Videos</b>
                                @endif
                              </div>
                          </div>
                          <!-- // Gallery -->
                      </div>


                      <div class="tab-pane fade" id="tab-5-pane" role="tabpanel" aria-labelledby="tab-5" tabindex="0">
                          <!-- FAQ -->
                          <h2 class="mt_30">Frequently Asked Questions</h2>
                          <div class="faq-package">
                              <div class="accordion" id="accordionExample">
                                @if (count($package_faqs) > 0)
                                  @foreach ($package_faqs as $i => $package_faq)
                                  <div class="accordion-item mb_30">
                                      <h2 class="accordion-header" id="heading_1">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $i }}" aria-expanded="false" aria-controls="collapse_{{ $i }}">
                                              {{ $package_faq->question }}?
                                          </button>
                                      </h2>
                                      <div id="collapse_{{ $i }}" class="accordion-collapse collapse" aria-labelledby="heading_1" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                            {{ $package_faq->answer }}
                                          </div>
                                      </div>
                                  </div>
                                  @endforeach
                                @else
                                  <b>No FAQs</b>
                                @endif
                          
                              </div>
                          </div>
                          <!-- // FAQ -->
                      </div>


                      <div class="tab-pane fade review-package-container mt_30" id="tab-6-pane" role="tabpanel" aria-labelledby="tab-6" tabindex="0">
                          <!-- Review -->
                          <div class="review-package">

                              <h2>Reviews ({{ count($reviews) }})</h2>

                              @if (count($reviews) > 0)
                                @foreach ($reviews as $review)
                                <div class="review-package-section">
                                    <div class="review-package-box d-flex justify-content-start">
                                        <div class="left">
                                          @if ($review->user->photo)
                                            <img src="{{ asset('uploads/user/' . $review->user->photo) }}" alt="{{ $review->user->name }}">
                                          @else
                                            <img src="{{ asset('images/default.png') }}" alt="Default User Image">
                                          @endif
                                        </div>
                                        <div class="right">
                                            <div class="name">{{ $review->user->name }}</div>
                                            <div class="date">
                                              {{ $review->created_at->format('F j, Y') }}

                                              <div class="review">
                                                  <div class="set">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                      @if ($i <= $review->rating)
                                                        <i style="color: rgba(255, 183, 0, 0.73)" class="fas fa-star"></i>
                                                      @else
                                                        <i style="color: rgba(255, 183, 0, 0.73)" class="far fa-star"></i>
                                                      @endif
                                                    @endfor
                                                  </div>
                                              </div>
                                            </div>
                                          
                                            <div class="text">
                                              {{ $review->comment }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                              @else
                                <b>No Reviews Found</b>
                              @endif
                             
                            
                              <div class="mt_40"></div>

                              <h2>Leave Your Review</h2>

                              @if (Auth::guard('web')->check())
                                @php
                                  $can_review = App\Models\Booking::where(['package_id' => $package->id, 'user_id' => Auth::guard('web')->user()->id, 'payment_status' => 'COMPLETED'])->first();
                                @endphp

                                @if ($can_review)
                                  @php
                                    $has_existing_review = App\Models\Review::where(['package_id' => $package->id, 'user_id' => Auth::guard('web')->user()->id])->first();
                                  @endphp

                                  @if (!$has_existing_review)
                                    <form action="{{ route('review', [$package->id, Auth::guard('web')->user()->id]) }}" method="POST">
                                      @csrf
                                      <div class="mb-3">
                                          <div class="give-review-auto-select">
                                              <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                                              <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                                              <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                                              <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                                              <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                                          </div>
                                          <script>
                                              document.addEventListener('DOMContentLoaded', (event) => {
                                                  const stars = document.querySelectorAll('.star-rating label');
                                                  stars.forEach(star => {
                                                      star.addEventListener('click', function() {
                                                          stars.forEach(s => s.style.color = '#ccc');
                                                          this.style.color = '#f5b301';
                                                          let previousStar = this.previousElementSibling;
                                                          while(previousStar) {
                                                              if (previousStar.tagName === 'LABEL') {
                                                                  previousStar.style.color = '#f5b301';
                                                              }
                                                              previousStar = previousStar.previousElementSibling;
                                                          }
                                                      });
                                                  });
                                              });
                                          </script>
                                      </div>
                                    
                                      <div class="mb-3">
                                          <textarea class="form-control" rows="3" placeholder="Comment" name="comment"></textarea>
                                      </div>
                                      <div class="mb-3">
                                          <button type="submit" class="btn btn-submit">Submit</button>
                                      </div>
                                    </form>
                                  @else
                                    <div class="alert alert-success">You have rated and reviewed this package already.</div>  
                                  @endif
                                @else
                                  <div class="alert alert-danger">You need to book first with this package and payment completed to review.</div>            
                                @endif  
                              @else
                                <a href="{{ route('login') }}" class="btn btn-login">Login to Review</a>
                              @endif
                          </div>
                          <!-- // Review -->
                      </div>



                      <div class="tab-pane fade enquery-form-container mt_30" id="tab-7-pane" role="tabpanel" aria-labelledby="tab-7" tabindex="0">
                          <!-- Inquiry -->
                          <h2>Ask Your Question</h2>
                          <div class="enquery-form">
                              <form action="{{ route('send_inquiry') }}" method="POST">
                                  @csrf
                                  <div class="mb-3">
                                      <input type="text" class="form-control" placeholder="Full Name" name="full_name" value="{{ old('full_name') }}">
                                  </div>
                                  <div class="mb-3">
                                      <input type="email" class="form-control" placeholder="Email Address" name="email" value="{{ old('email') }}">
                                  </div>
                                  <div class="mb-3">
                                      <input type="text" class="form-control" placeholder="Phone Number" name="phone_number" value="{{ old('phone_number') }}">
                                  </div>
                                  <div class="mb-3">
                                      <textarea class="form-control h-150" rows="3" placeholder="Message" name="message">{{ old('message') }}</textarea>
                                  </div>
                                  <div>
                                      <button type="submit" class="btn">
                                          Send Message
                                      </button>
                                  </div>
                              </form>
                          </div>
                          <!-- // Inquiry -->
                      </div>


                      <div class="tab-pane fade" id="tab-8-pane" role="tabpanel" aria-labelledby="tab-8" tabindex="0">
                          <!-- Booking -->
                          <form action="{{ route('payment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $package->id }}"> 
                            <div class="row">
                                <div class="col-md-8">
                                  @php 
                                    $i = 0; 
                                  @endphp
                                  <div class="row">
                                    @foreach ($package_tours as $package_tour)
                                      @if ($package_tour->booking_end_date <= date('Y-m-d'))
                                        @continue
                                      @endif
                                  
                                      @php 
                                        $i += 1; 
                                        $total_booked_seats = 0;

                                        $all_data = App\Models\Booking::where(['package_tour_id' => $package_tour->id, 'package_id' => $package->id])->get();

                                        foreach ($all_data as $data) {
                                          $total_booked_seats += $data->total_person;
                                        }                               
                                      @endphp

                                      <div class="col-md-12">
                                        <h2 class="mt_30">
                                          <input type="radio" name="package_tour_id" value="{{ $package_tour->id }}">
                                          <span>Tour {{ $i }}</span>
                                        </h2>
                                        <div class="summary">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td><b>Tour Start Date</b></td>
                                                        <td>
                                                            {{ $package_tour->tour_start_date }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Tour End Date</b></td>
                                                        <td>
                                                          {{ $package_tour->tour_end_date }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                      <td><b>Booking End Date</b></td>
                                                      <td class="text-danger">
                                                        {{ $package_tour->booking_end_date }}
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Total Seat</b></td>
                                                        <td>
                                                          {{ $package_tour->total_seat }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                      <td><b>Booked Seat</b></td>
                                                      <td>
                                                          {{ $total_booked_seats }}
                                                      </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                      </div>
                                    @endforeach

                                    
                                    @if ($current_total_tours === 0)
                                      <b class="text-center mt-5">No Tours Yet</b>
                                    @endif
                                  </div>
                                </div>

                                <div class="col-md-4 payment-container mt_30">
                                    <h2>Payment</h2>
                                      <div>
                                        <div class="mb-3">
                                          <input type="hidden" name="ticket_price" id="ticketPrice" value="{{ $package->price }}">
                                          <label for=""><b>Number of Persons</b></label>
                                          <input type="number" min="1" max="100" name="total_person" class="form-control" value="1" id="numPersons" oninput="calculateTotal()">
                                        </div>

                                        <div class="mb-3">
                                          <label for=""><b>Total</b></label>
                                          <input type="text" name="paid_amount" class="form-control" id="totalAmount" value="${{ $package->price }}" disabled>
                                        </div>

                                        <div class="mb-4">
                                          <label for=""><b>Select Payment Method</b></label>
                                          <select name="payment_method" class="form-select">
                                              <option value="paypal">PayPal</option>
                                              <option value="stripe">Stripe</option>
                                              <option value="cash">Cash</option>
                                          </select>
                                        </div>

                                        <div>
                                          @if (Auth::guard('web')->check())
                                            <button type="submit" class="btn btn-submit">Pay Now</button>
                                          @else
                                            <a href="{{ route('login') }}"  class="btn btn-submit">Login First</a>
                                          @endif
                                        </div>
                                      </div>
                              
                                    <script>
                                        function calculateTotal() {
                                            const ticketPrice = document.getElementById('ticketPrice').value;
                                            const numPersons = document.getElementById('numPersons').value;
                                            const totalAmount = ticketPrice * numPersons;
                                            document.getElementById('totalAmount').value = `$${totalAmount}`;
                                        }
                                    </script>
                                </div>
                            </div>
                          </form>
                          <!-- // Booking -->
                      </div>

                  </div>
                  
              </div>
                  

          </div>
      </div>
  </div>
</div>
@endsection