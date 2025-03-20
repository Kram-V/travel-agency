@extends('front.layout.master')


@section('content')
<div class="page-top" style="background-image: url({{ asset('images/banner.jpg') }})">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>Invoice</h2>
              <div class="breadcrumb-container">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('bookings') }}">Bookings</a></li>
                      <li class="breadcrumb-item active">Invoice</li>
                  </ol>
              </div>
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
              <div class="invoice-container" id="print_invoice">
                  <div class="invoice-top">
                      <div class="row">
                          <div class="col-12">
                              <div class="table-responsive">
                                  <table class="table table-bordered table-border-0">
                                      <tbody>
                                          <tr>
                                              <td class="">
                                                  <h2>EscapeEase</h2  > 
                                              </td>
                                              <td class="w-50">
                                                  <div class="invoice-top-right">
                                                      <h4>Invoice</h4>
                                                      <h5>Order No: {{ $user_booking->invoice_no }}</h5>
                                                      <h5>Date: {{ $user_booking->created_at->format('F j, Y') }}</h5>
                                                  </div>
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>    
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="invoice-middle">
                      <div class="row">
                          <div class="col-12">
                              <div class="table-responsive">
                                  <table class="table table-bordered table-border-0">
                                      <tbody>
                                          <tr>
                                              <td class="w-50">
                                                  <div class="invoice-middle-left">
                                                      <h4>Invoice To:</h4>
                                                      <p class="mb_0">{{ Auth::guard('web')->user()->name }}</p>
                                                      <p class="mb_0">{{ Auth::guard('web')->user()->email }}</p>
                                                      <p class="mb_0">{{ Auth::guard('web')->user()->phone }}</p>
                                                      <p class="mb_0">{{ Auth::guard('web')->user()->city }}, {{ Auth::guard('web')->user()->state }}</p>
                                                      <p class="mb_0">{{ Auth::guard('web')->user()->country }}</p>
                                                  </div>
                                              </td>
                                              <td class="w-50">
                                                  <div class="invoice-middle-right">
                                                      <h4>Invoice From:</h4>
                                                      <p class="mb_0">{{ $admin_user->name }}</p>
                                                      <p class="mb_0 color_6d6d6d">{{ $admin_user->email }}</p>
                                                      <p class="mb_0">09133871785</p>
                                                      <p class="mb_0">3145 Glen Falls Road</p>
                                                      <p class="mb_0">Bensalem, PA 19020</p>
                                                  </div>
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="invoice-item">
                      <div class="row">
                          <div class="col-12">
                              <div class="table-responsive">
                                  <table class="table table-bordered invoice-item-table">
                                      <tbody>
                                          <tr>
                                              <th>SL</th>
                                              <th>Package</th>
                                              <th>Start Date</th>
                                              <th>End Date</th>
                                              <th>Ticket Price</th>
                                              <th>Tickets</th>
                                              <th>Total Price</th>
                                          </tr>
                                          <tr>
                                              <td>1</td>
                                              <td>{{ $user_booking->package->name }}</td>
                                              <td>{{ \Carbon\Carbon::parse($user_booking->package_tour->tour_start_date)->format('F j, Y') }}</td>
                                              <td>{{ \Carbon\Carbon::parse($user_booking->package_tour->tour_end_date)->format('F j, Y') }}</td>
                                              <td>${{ $user_booking->package->price }}</td>
                                              <td>{{ $user_booking->total_person }}</td>
                                              <td>${{ $user_booking->paid_amount }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="invoice-bottom">
                      <div class="row">
                          <div class="col-12">
                              <div class="table-responsive">
                                  <table class="table table-bordered table-border-0">
                                      <tbody>
                                          <td class="w-70 invoice-bottom-payment">
                                              <h4>Payment Method</h4>
                                              <p>{{ ucfirst($user_booking->payment_method) }}</p>
                                          </td>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="print-button mt_25">
                  <a onclick="printInvoice()" href="javascript:;" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
              </div>
              <script>
                  function printInvoice() {
                      let body = document.body.innerHTML;
                      let data = document.getElementById('print_invoice').innerHTML;
                      document.body.innerHTML = data;
                      window.print();
                      document.body.innerHTML = body;
                  }
              </script>
          </div>
      </div>
  </div>
</div>
@endsection