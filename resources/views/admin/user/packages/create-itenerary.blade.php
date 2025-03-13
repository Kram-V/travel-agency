@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Iteneraries of {{ $package->name }}</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_packages_index') }}" class="btn btn-primary">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-md-4">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_packages_store_itenerary', $package->id) }}" method="POST"> 
                                @csrf
                                <div class="row">
                                  <div class="mb-4 form-group col-md-12">
                                    <label class="form-label">Name *</label>
                                    <input type="text" name='name' class="form-control" value="{{ old('name') }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-12">
                                    <label class="form-label">Description *</label>
                                    <textarea name="description" class="form-control editor h_100" rows="3">{{ old('description') }}</textarea>
                                  </div>


                                  <div class="mb-4">
                                      <button type="submit" class="btn btn-primary">Create</button>
                                  </div>
                                </div>
                        
                            </form>
                        </div>
                      </div>
                  </div>

                  <div class="col-md-8">
                    <div class="card">
                      <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($package_iteneraries as $package_itenerary)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>
                                        {{ $package_itenerary->name }}
                                      </td>    
                                      <td>
                                        {!! $package_itenerary->description !!}
                                      </td>
                                      <td class="pt_10 pb_10">
                                          <form action="{{ route('admin_packages_delete_itenerary', $package_itenerary->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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