@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Testimonials</h1>
              <div class="ml-auto">
                <a href="{{ route('admin_testimonials_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Position</th> 
                                            <th>Company</th> 
                                            <th>Comment</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($testimonials as $testimonial)
                                      <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>
                                            @if (!$testimonial->photo)
                                              <img src="{{ asset('images/default.png') }}" alt="Default" class="profile-photo w_100">
                                            @else
                                              <img src="{{ asset("uploads/testimonials/{$testimonial->photo}") }}" alt="{{ $testimonial->name }}" class="profile-photo w_100">
                                            @endif
                                          </td>
                                          <td>{{ $testimonial->name }}</td>
                                          <td>{{ $testimonial->position }}</td>
                                          <td>{{ $testimonial->company }}</td>
                                          <td>{{ $testimonial->comment }}</td>
                                          <td class="pt_10 pb_10">
                                              <a href="{{ route('admin_testimonials_edit', $testimonial->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                              <form action="{{ route('admin_testimonials_delete', $testimonial->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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