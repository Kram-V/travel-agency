@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Videos of {{ $package->name }}</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_packages_index') }}" class="btn btn-primary">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-md-6">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_packages_store_video', $package->id) }}" method="POST"> 
                                @csrf
                                <div class="row">
                                  <div class="mb-3 form-group col-md-12">
                                    <label class="form-label">Video * (Youtube Video Id)</label>
                                    <input type="text" class="form-control" name="video">
                                  </div>

                                  <div class="mb-4">
                                      <button type="submit" class="btn btn-primary">Create</button>
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
                                        <th>Video</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($package_videos as $package_video)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>
                                        <iframe width="360" height="215" src="https://www.youtube.com/embed/{{ $package_video->video }}" 
                                          title="YouTube video player" frameborder="0" 
                                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                          allowfullscreen>
                                      </iframe>
                                      </td>            
                                      <td class="pt_10 pb_10">
                                          <form action="{{ route('admin_packages_delete_video', $package_video->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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