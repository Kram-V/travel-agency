@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Amenities of {{ $package->name }}</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_packages_index') }}" class="btn btn-primary">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-md-4">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_packages_store_amenity', $package->id) }}" method="POST"> 
                                @csrf
                                <div class="row">
                                  <div class="mb-4 form-group col-md-12">
                                    <label class="form-label">Amenity *</label>
                                    <select name="amenity" class="form-control">
                                      <option value="">Select Amenity</option>
                                      @foreach ($amenities as $amenity)
                                        <option value="{{ $amenity->id }}" {{ old('amenity') == $amenity->id ? 'selected' : '' }}>{{ $amenity->name }}</option>
                                      @endforeach
                                    </select>
                                  </div>

                                  <div class="mb-4 form-group col-md-12">
                                    <label class="form-label">Type *</label>
                                    <select name="type" class="form-control">
                                      <option value="">Select Type</option>
                                      <option value="included" {{ old('type') == 'included' ? 'selected' : '' }}>Included</option>
                                      <option value="excluded" {{ old('type') == 'excluded' ? 'selected' : '' }}>Excluded</option>
                                    </select>
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
                                        <th>Amenity</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($package_amenities as $package_amenity)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>
                                        {{ $package_amenity->amenity->name }}
                                      </td>    
                                      <td>
                                        <span style="background-color: {{ $package_amenity->type === 'excluded' ? 'red' : 'green' }}; padding: 2px 8px; color: white;  border-radius: 10px;">
                                          {{ ucfirst($package_amenity->type) }}
                                        </span>   
                                      <td class="pt_10 pb_10">
                                          <form action="{{ route('admin_packages_delete_amenity', $package_amenity->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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