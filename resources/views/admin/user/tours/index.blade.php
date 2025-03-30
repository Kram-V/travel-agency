@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Tours</h1>
              <div class="ml-auto">
                <a href="{{ route('admin_tours_create') }}"><i class="fas fa-plus"></i> Add New</a>
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
                                            <th>Package Name</th>
                                            <th>Tour Start</th>
                                            <th>Tour End</th>
                                            <th>Booking End</th>
                                            <th>Total Seat</th>
                                            <th>Booking</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($package_tours as $package_tour)
                                      <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>
                                            <a href="{{ route('package', $package_tour->package->slug) }}" target="_blank">
                                              {{ $package_tour->package->name }}
                                            </a>
                                          </td>
                                          <td>{{ $package_tour->tour_start_date }}</td>
                                          <td>{{ $package_tour->tour_end_date }}</td>
                                          <td>{{ $package_tour->booking_end_date }}</td>
                                          <td>{{ $package_tour->total_seat }}</td>
                                          <td><a href="{{ route('admin_tour_booking', [$package_tour->id, $package_tour->package->id]) }}" class="btn btn-success btn-sm">Booking Details</a></td>
                                          <td class="pt_10 pb_10">
                                              <a href="{{ route('admin_tours_edit', $package_tour->id) }}" class="btn btn-edit"><i class="fas fa-edit"></i></a>
                                              <form action="{{ route('admin_tours_delete', $package_tour->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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