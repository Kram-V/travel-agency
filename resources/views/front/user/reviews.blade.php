@extends('front.layout.master')


@section('content')
<div class="page-top" style="background-image: url({{ asset('images/banner.jpg') }})">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>My Reviews</h2>
              <div class="breadcrumb-container">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                      <li class="breadcrumb-item active">Reviews</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="page-content user-panel pt_70 pb_70">
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-3 col-md-12">
              <div class="card">
                @include('front.user.sidebar')
              </div>
          </div>
          <div class="col-lg-9 col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>SL</th>
                            <th>Photo</th>
                            <th>Package</th>
                            <th>Destination</th>
                            <th>My Rating</th>
                            <th>My Comment</th>
                        </tr>
                        @foreach ($reviews as $review)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                              <img src="{{ asset('uploads/packages/' . $review->package->featured_photo) }}" alt="{{ $review->package->name }}" class="w-200">
                            </td>
                            <td>
                              {{$review->package->name}}
                            </td>
                            <td>
                              {{$review->package->destination->name}}
                            </td>
                            <td>
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
                            </td>
                            <td>
                               {{ $review->comment }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
  </div>
</div>
@endsection