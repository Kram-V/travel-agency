@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Edit Tour</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_tours_index') }}">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_tours_update', $tour->id) }}" method="POST"> 
                                @csrf
                                @method('PUT')
                                <div class="row">
                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Package *</label>
                                    <select name="package" class="form-select">
                                      <option value="">Select Package</option>

                                      @foreach ($packages as $package)
                                        <option value="{{ $package->id }}" {{ $tour->package_id == $package->id ? 'selected' : '' }}>{{ $package->name }}</option>
                                      @endforeach
                                    </select>
                                  </div>

                                  <div class="mb-4 form-group col-md-6">
                                    <label class="form-label">Total Seat *</label>
                                    <input type="text" name="total_seat" class="form-control" value="{{ $tour->total_seat }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-4">
                                    <label class="form-label">Tour Start Date *</label>
                                    <input type="date" name="tour_start_date" class="form-control" value="{{ $tour->tour_start_date }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-4">
                                    <label class="form-label">Tour End Date *</label>
                                    <input type="date" name="tour_end_date" class="form-control" value="{{ $tour->tour_end_date }}">
                                  </div>

                                  <div class="mb-4 form-group col-md-4">
                                    <label class="form-label">Booking End Date *</label>
                                    <input type="date" name="booking_end_date" class="form-control" value="{{ $tour->booking_end_date }}">
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