@extends('front.layout.master')

@section('content')
<div class="page-top" style="background-image: url({{ asset('images/banner.jpg') }})">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>Contact</h2>
          </div>
      </div>
  </div>
</div>

<div class="contact pt_70 pb_70"> 
  <div class="container">
      <div class="row">
          <div class="col-lg-6 col-md-12">
              <div class="contact-form">
                  <form action="{{ route('send_contact') }}" method="POST">
                    @csrf
                      <div class="mb-3">
                          <label for="" class="form-label">Name *</label>
                          <input type="text" class="form-control" name="name">
                      </div>
                      <div class="mb-3">
                          <label for="" class="form-label">Email Address *</label>
                          <input type="text" class="form-control" name="email">
                      </div>
                      <div class="mb-3">
                          <label for="" class="form-label">Message *</label>
                          <textarea class="form-control" rows="3" name="message"></textarea>
                      </div>
                      <div>
                          <button type="submit">
                              Send Message
                          </button>
                      </div>
                  </form>
              </div>
          </div>
          <div class="col-lg-6 col-md-12">
              <div class="map">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2799198932!2d-74.25987701513004!3d40.69767006272707!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1645362221879!5m2!1sen!2sbd"  style="border: 0" allowfullscreen="" loading="lazy"></iframe>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection