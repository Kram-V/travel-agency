@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Create FAQ</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_faqs_index') }}">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_faqs_store') }}" method="POST"> 
                                @csrf
                                <div class="row">
                                  <div class="mb-4 form-group col-md-12">
                                    <label class="form-label">Question *</label>
                                    <input type="text" class="form-control" name="question" value="{{ old('question') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-12">
                                    <label class="form-label">Answer *</label>
                                    <textarea name="answer" class="form-control h_100" rows="3">{{ old('answer') }}</textarea>
                                  </div>

                                  <div class="mb-4">
                                      <button type="submit">Create</button>
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