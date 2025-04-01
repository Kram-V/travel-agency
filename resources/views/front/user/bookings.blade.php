@extends('front.layout.master')


@section('content')
<div class="page-top" style="background-image: url({{ asset('images/banner.jpg') }})">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>Bookings</h2>
          </div>
      </div>
  </div>
</div>

<div class="page-content user-panel pt_70 pb_70">
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-3 col-md-12">
              <div class="card">
                @include('front.user.sidebar')
              </div>
          </div>
          <div class="col-lg-9 col-md-12">
              <div class="table-responsive">
                  <table class="table table-bordered">
                      <tbody>
                          <tr>
                              <th>SL</th>
                              <th>Package</th>
                              <th>Destination</th>
                              <th>Paid Amount</th>
                              <th>Payment Method</th>
                              <th>Payment Date</th>
                              <th>Status</th>
                              <th class="w-100">
                                  Action
                              </th>
                          </tr>
                          @foreach ($user_bookings as $user_booking)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>
                                  <a href="{{ route('package', $user_booking->package->slug) }}" target="_blank" class="text-decoration-underline">{{ $user_booking->package->name }}</a>
                              </td>
                              <td>
                                  <a href="{{ route('destination', $user_booking->package->destination->slug) }}" target="_blank" class="text-decoration-underline">{{ $user_booking->package->destination->country }}</a>
                              </td>
                              <td>${{ $user_booking->paid_amount }}</td>
                              <td>{{ ucfirst($user_booking->payment_method) }}</td>
                              <td>{{ $user_booking->created_at->format('F j, Y')  }}</td>
                              <td>
                                  <div class="badge {{ $user_booking->payment_status === 'COMPLETED' ? 'bg-success' : 'bg-warning' }}">{{ $user_booking->payment_status }}</div>
                              </td>
                              <td>
                                  <a href="" class="btn btn-secondary btn-sm mb-1 w-100-p" data-bs-toggle="modal" data-bs-target="#modal-{{ $loop->iteration }}">Details</a>
                                  <a href="{{ route('invoice', $user_booking->invoice_no) }}" target="_blank" class="btn btn-secondary btn-sm w-100-p">Invoice</a>
                              </td>
                          </tr>
                         
                          <!-- Modal -->
                          <div class="modal fade" id="modal-{{ $loop->iteration }}" tabindex="-1" aria-labelledby="modal-label-1" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="modal-label-1">Details</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <div class="mb-3 row modal-seperator">
                                              <div class="col-md-5">
                                                  <b>Order No:</b>
                                              </div>
                                              <div class="col-md-7">
                                                  {{ $user_booking->invoice_no }}
                                              </div>
                                          </div>
                                          <div class="mb-3 row modal-seperator">
                                              <div class="col-md-5">
                                                  <b>Package Name:</b>
                                              </div>
                                              <div class="col-md-7">
                                                {{ $user_booking->package->name }}
                                              </div>
                                          </div>
                                          <div class="mb-3 row modal-seperator">
                                              <div class="col-md-5">
                                                  <b>Destination:</b>
                                              </div>
                                              <div class="col-md-7">
                                                {{ $user_booking->package->destination->country }}
                                              </div>
                                          </div>
                                          <div class="mb-3 row modal-seperator">
                                              <div class="col-md-5">
                                                  <b>Total Persons:</b>
                                              </div>
                                              <div class="col-md-7">
                                                {{ $user_booking->total_person }}
                                              </div>
                                          </div>
                                          <div class="mb-3 row modal-seperator">
                                              <div class="col-md-5">
                                                  <b>Per Person Cost:</b>
                                              </div>
                                              <div class="col-md-7">
                                                ${{ $user_booking->package->price }}
                                              </div>
                                          </div>
                                          <div class="mb-3 row modal-seperator">
                                              <div class="col-md-5">
                                                  <b>Total Cost:</b>
                                              </div>
                                              <div class="col-md-7">
                                                ${{ $user_booking->paid_amount }}
                                              </div>
                                          </div>
                                          <div class="mb-3 row modal-seperator">
                                              <div class="col-md-5">
                                                  <b>Payment Method:</b>
                                              </div>
                                              <div class="col-md-7">
                                                {{ ucfirst($user_booking->payment_method) }}
                                              </div>
                                          </div>
                                          <div class="mb-3 row modal-seperator">
                                              <div class="col-md-5">
                                                  <b>Travel Start Date:</b>
                                              </div>
                                              <div class="col-md-7">
                                                {{ \Carbon\Carbon::parse($user_booking->package_tour->tour_start_date)->format('F j, Y') }}
                                              </div>
                                          </div>
                                          <div class="mb-3 row modal-seperator">
                                              <div class="col-md-5">
                                                  <b>Travel End Date:</b>
                                              </div>
                                              <div class="col-md-7">
                                                {{ \Carbon\Carbon::parse($user_booking->package_tour->tour_end_date)->format('F j, Y') }}
                                              </div>
                                          </div>
                                          <div class="mb-3 row modal-seperator">
                                              <div class="col-md-5">
                                                  <b>Payment Status:</b>
                                              </div>
                                              <div class="col-md-7">
                                                  <div class="badge {{ $user_booking->payment_status === 'COMPLETED' ? 'bg-success' : 'bg-warning' }}">{{ $user_booking->payment_status }}</div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          @endforeach
                          <!-- // Modal -->
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection