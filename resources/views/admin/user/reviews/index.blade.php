@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Reviews</h1>
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
                                            <th>Customer Name</th>
                                            <th>Package Name</th>
                                            <th>Rating</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($reviews as $review)
                                      <tr>
                                          <td>
                                            {{ $loop->iteration }}
                                          </td>
                                          <td>{{ $review->user->name }}</td>
                                          <td>{{ $review->package->name }}</td>
                                          <td>
                                            <div class="review">
                                                <div class="set">
                                                  @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rating)
                                                      <i style="color: rgba(255, 183, 0, 0.73)" class="fas fa-star"></i>
                                                    @else
                                                      <i style="color: rgba(255, 183, 0, 0.73)" class="far fa-star"></i>
                                                    @endif
                                                  @endfor
                                                </div>
                                            </div>
                                          </td>
                                          <td>{{ $review->comment }}</td>
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