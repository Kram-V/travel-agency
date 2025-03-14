@extends('front.layout.master')

@section('content')
<div class="page-top" style="background-image: url('images/banner.jpg')">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>Destinations</h2>
              <div class="breadcrumb-container">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                      <li class="breadcrumb-item active">Destinations</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="destination pt_70 pb_50">
  <div class="container">
      <div class="row">
        @foreach ($destinations as $destination)
        <div class="col-lg-3 col-md-6">
            <div class="item pb_25">
                <div class="photo">
                    <a href="{{ route('destination', $destination->slug) }}"><img src="{{ asset('uploads/destinations/' . $destination->featured_photo) }}" alt="{{ $destination->name }}"></a>
                </div>
                <div class="text">
                    <h2>
                        <a href="{{ route('destination', $destination->slug) }}">{{ $destination->country }}</a>
                    </h2>
                </div>
            </div>
        </div>
        @endforeach
      </div>
  </div>
</div>
@endsection