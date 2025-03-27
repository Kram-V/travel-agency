@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Send Email To All Subscribers</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_subscribers_index') }}" class="btn btn-primary">Back to subscribers</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_subscribers_send_email') }}" method="POST"> 
                                @csrf
                                <div class="row">
                                  <div class="mb-4 form-group col-12">
                                      <label class="form-label">Subject *</label>
                                      <input type="text" class="form-control" name="subject" value="{{ old('subject') }}">
                                  </div>

                                  <div class="mb-4 form-group col-12">
                                    <label class="form-label">Message *</label>
                                    <textarea name="message" class="form-control h_100" rows="3">{{ old('message') }}</textarea>
                                  </div>

                                  <div class="mb-4">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                </div>
                        
                            </form>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </div>
@endsection