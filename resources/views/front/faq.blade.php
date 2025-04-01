@extends('front.layout.master')

@section('content')
<div class="page-top" style="background-image: url({{ asset('images/banner.jpg') }})">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>FAQ</h2>
          </div>
      </div>
  </div>
</div>

<div class="faq pt_70 pb_40">
  <div class="container">
      <div class="row">
          <div class="col-md-12 d-flex justify-content-center">
              <div class="accordion" id="accordionExample">
                @foreach ($faqs as $i => $faq)
                  <div class="accordion-item mb_30">
                      <h2 class="accordion-header" id="heading_1">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $i }}" aria-expanded="false" aria-controls="collapse_1">
                              {{ $faq->question }}
                          </button>
                      </h2>
                      <div id="collapse_{{ $i }}" class="accordion-collapse collapse" aria-labelledby="heading_1" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            {{ $faq->answer }}
                          </div>
                      </div>
                  </div>
                @endforeach
              </div>
          </div>
      </div>
  </div>
</div>
@endsection