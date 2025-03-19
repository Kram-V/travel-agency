@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Tour Booking Details</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_tours_index') }}" class="btn btn-primary">Back to listing</a>
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
                                        <th>Invoice No</th>
                                        <th>Package Name</th>
                                        <th>User Details</th>
                                        <th>Total Person</th>
                                        <th>Paid Amount</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($tour_bookings as $tour_booking)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>
                                        {{ $tour_booking->invoice_no }}
                                      </td>
                                      <td>
                                        {{ $tour_booking->package->name }}
                                      </td>
                                      <td>
                                        <strong>Name: </strong>{{ $tour_booking->user->name }}<br />
                                        <strong>Email: </strong>{{ $tour_booking->user->email }}<br />
                                        <strong>Phone: </strong>{{ $tour_booking->user->phone }}
                                      </td>
                                      <td>{{ $tour_booking->total_person }}</td>
                                      <td>{{ $tour_booking->paid_amount }}</td>
                                      <td>{{ $tour_booking->payment_method }}</td>
                                      <td>
                                        <span class="badge bg-success">{{ $tour_booking->payment_status }}</span>
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