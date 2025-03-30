@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Messages</h1>
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
                                            <th>User Details</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($messages as $message)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                              <b>{{ $message->user->name }}</b> <br />
                                              {{ $message->user->email }} <br />
                                              {{ $message->user->phone }} 
                                            </td>
                                            <td class="pt_10 pb_10 messages-container">
                                              <a href="{{ route('admin_messages_message_details' , $message->id) }}">Messages</a>
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