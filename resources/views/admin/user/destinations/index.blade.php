@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Destinations</h1>
              <div class="ml-auto">
                <a href="{{ route('admin_destinations_create') }}"><i class="fas fa-plus"></i> Add New</a>
            </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Featured Photo</th>
                                            <th>Name</th>
                                            <th>Slug</th> 
                                            <th>Gallery</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($destinations as $destination)
                                      <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>
                                            <img src="{{ asset("uploads/destinations/{$destination->featured_photo}") }}" alt="{{ $destination->name }}" class="profile-photo w_200">
                                          </td>
                                          <td>{{ $destination->name }}</td>
                                          <td>{{ $destination->slug }}</td>
                                          <td>
                                            <a href="{{ route('admin_destinations_create_photo', $destination->id) }}" class="btn btn-success btn-sm">Photo Gallery</a>
                                            <a href="{{ route('admin_destinations_create_video', $destination->id) }}" class="btn btn-success btn-sm">Video Gallery</a>
                                          </td>
                                          <td class="pt_10 pb_10">
                                              <a href="{{ route('admin_destinations_show', $destination->id) }}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                                              <a href="{{ route('admin_destinations_edit', $destination->slug) }}" class="btn btn-edit"><i class="fas fa-edit"></i></a>
                                              <form action="{{ route('admin_destinations_delete', $destination->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete">
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