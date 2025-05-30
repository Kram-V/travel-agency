@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')

  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header">
              <h1>Dashboard</h1>
          </div>
          <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                      <div class="card-icon bg-primary">
                          <i class="far fa-user"></i>
                      </div>
                      <div class="card-wrap">
                          <div class="card-header">
                              <h4>Total Customers</h4>
                          </div>
                          <div class="card-body">
                              {{ $total_customers }}
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                      <div class="card-icon bg-success">
                          <i class="fas fa-book-open"></i> 
                      </div>
                      <div class="card-wrap">
                          <div class="card-header">
                              <h4>Total Bookings</h4>
                          </div>
                          <div class="card-body">
                              {{ $total_bookings }}
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                      <div class="card-icon bg-danger">
                        <i class="fas fa-box"></i>
                      </div>
                      <div class="card-wrap">
                          <div class="card-header">
                              <h4>Total Packages</h4>
                          </div>
                          <div class="card-body">
                              {{ $total_packages }}
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                      <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Subscribers</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_subscribers }}
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                      <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Destinations</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_destinations }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-comment"></i>
                  </div>
                  <div class="card-wrap">
                      <div class="card-header">
                          <h4>Total Testimonials</h4>
                      </div>
                      <div class="card-body">
                          {{ $total_testimonials }}
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                      <i class="fas fa-pen"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Blog Posts</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_blogs }}
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </section>
  </div>
@endsection
   