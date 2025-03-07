@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Features</h1>
              <div class="ml-auto">
                <a href="{{ route('admin_features_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                            <th>Icon</th>
                                            <th>Heading</th>
                                            <th>Description</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($features as $feature)
                                      <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>
                                              <i class="{{ $feature->icon }}"></i>
                                          </td>
                                          <td> {{ $feature->heading }}</td>
                                          <td> {{ $feature->description }}</td>
                                          <td class="pt_10 pb_10">
                                              <a href="{{ route('admin_features_edit', $feature->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                              <form action="{{ route("admin_features_delete", $feature->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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