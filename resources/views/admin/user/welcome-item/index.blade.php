@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header">
              <h1>Edit Welcome Item</h1>
          </div>

          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_welcome_item_update') }}" method="POST" enctype="multipart/form-data"> 
                                @csrf
                                <img style="width: 130px" src="{{ asset('uploads/welcome-item/' . $welcome_item->photo) }}" alt="{{ $welcome_item->heading }}">
                                <div class="row">               
                                  <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">Photo</label>
                                    <input type="file" class="form-control" name="photo">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Heading *</label>
                                      <input type="text" class="form-control" name="heading" value="{{ $welcome_item->heading }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Video (Youtube Id) *</label>
                                    <input type="text" class="form-control" name="video_id" value="{{ $welcome_item->video_id }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Status *</label>
                                    <input style="cursor: not-allowed;" type="text" class="form-control" name="status" value="{{ $welcome_item->status }}" readonly>
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Button Text</label>
                                      <input type="text" class="form-control" name="button_text" value="{{ $welcome_item->button_text }}">
                                  </div>
                          
                                  <div class="mb-4 form-group col-md-6">
                                      <label class="form-label">Button Link</label>
                                      <input type="text" class="form-control" name="button_link" value="{{ $welcome_item->button_link }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Description *</label>
                                    <textarea name="description" class="form-control h_100" rows="3" maxlength="1000">{{$welcome_item->description}}</textarea>
                                  </div>

                                  <div class="mb-4">
                                      <button type="submit">Update</button>
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