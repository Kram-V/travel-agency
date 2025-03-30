@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Photos of {{ $destination->country }}</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_destinations_index') }}">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-md-6">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_destinations_store_photo', $destination->id) }}" method="POST" enctype="multipart/form-data"> 
                                @csrf
                                <div class="row">
                                  <div class="mb-3 form-group col-md-12">
                                    <label class="form-label">Photo *</label>
                                    <input type="file" class="form-control" name="photo">
                                  </div>

                                  <div class="mb-4">
                                      <button type="submit">Create</button>
                                  </div>
                                </div>
                        
                            </form>
                        </div>
                      </div>
                  </div>

                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Photo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($destination_photos as $destination)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>
                                        <img src="{{ asset("uploads/destination-photos/{$destination->photo}") }}" class="profile-photo w_200">
                                      </td>            
                                      <td class="pt_10 pb_10">
                                          <form action="{{ route('admin_destinations_delete_photo', $destination->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
          </div>
      </section>
  </div>
@endsection