@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Invoice</h1>
        </div>
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Invoice # {{ $invoice_no }}</h2>
                            </div>
                            <hr>
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <address>
                                        <strong>Invoice To</strong><br>
                                        {{ $booking_details->user->name }}<br>
                                        {{ $booking_details->user->email }}<br>
                                        {{ $booking_details->user->phone }}<br>
                                        {{ $booking_details->user->city }}, {{ $booking_details->user->state }}<br>
                                        {{ $booking_details->user->country }}
                                    </address>
                                </div>
                                <div class="col-md-4">
                                    <address>
                                        <strong>Date</strong><br>
                                        {{ $booking_details->created_at->format('F j, Y') }}
                                    </address>
                                </div>
                                <div class="col-md-4">
                                  <address>
                                      <strong>Total Seat</strong><br>
                                      {{ $booking_details->package_tour->total_seat }}
                                  </address>
                                </div>

                                <div class="col-md-4">
                                  <address>
                                      <strong>Tour Start Date</strong><br>
                                      {{ $booking_details->package_tour->tour_start_date }}
                                  </address>
                                </div>

                                <div class="col-md-4">
                                  <address>
                                      <strong>Tour End Date</strong><br>
                                      {{ $booking_details->package_tour->tour_end_date }}
                                  </address>
                                </div>

                                <div class="col-md-4">
                                  <address>
                                      <strong>Booking End Date</strong><br>
                                      {{ $booking_details->package_tour->booking_end_date }}
                                  </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">Here put the order summary notification</p>
                            <hr class="invoice-above-table">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th>SL</th>
                                        <th>Package Name</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $booking_details->package->name }}</td>
                                        <td>{{ ucfirst($booking_details->payment_method) }}</td>
                                        <td>
                                          {{ $booking_details->payment_status }}
                                        </td>
                                        <td class="text-center">${{ $booking_details->package->price }}</td>
                                        <td class="text-center">{{ $booking_details->total_person }}</td>
                                        <td class="text-right">${{ $booking_details->paid_amount }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">${{ $booking_details->paid_amount }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-md-right">
                    <a href="javascript:window.print();" class="btn btn-warning btn-icon icon-left text-white print-invoice-button"><i class="fas fa-print"></i> Print</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection