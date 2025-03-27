@extends('front.layout.master')


@section('content')
<div class="page-top" style="background-image: url('images/banner.jpg')">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>Dashboard</h2>
              <div class="breadcrumb-container">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                      <li class="breadcrumb-item active">Message</li> 
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

          @if (!empty($message))
            <div class="col-lg-5 col-md-12">
              <h3>All Messages</h3>

              @if (count($message_comments) > 0)
                @foreach ($message_comments as $message_comment)
                  <div class="message-item {{ $message_comment->type == 'admin' ? 'message-item-admin-border' : '' }}">
                      <div class="message-top">
                          <div class="left">
                              @if ($message_comment->type === 'customer' && $message_comment->sender_non_admin->photo)
                                <img src="{{ asset('uploads/user/' . $message_comment->sender_non_admin->photo) }}" alt="{{ $message_comment->sender_non_admin->name }}">
                              @elseif ($message_comment->type === 'admin' && $message_comment->sender_admin->photo)
                                <img src="{{ asset('uploads/admin/' . $message_comment->sender_admin->photo) }}" alt="{{ $message_comment->sender_admin->name }}">
                              @else
                                <img src="{{ asset('images/default.png') }}" alt="Default">
                              @endif
                          </div>
                          <div class="right">
                              <h4>{{ $message_comment->type === 'customer' ?  $message_comment->sender_non_admin->name : $message_comment->sender_admin->name }}</h4>
                              <h5>{{ ucfirst($message_comment->type) }}</h5>
                              <div class="date-time">{{ $message_comment->created_at->format('Y-m-d h:i:s A') }}</div>
                          </div>
                      </div>
                      <div class="message-bottom">
                          <p>{{ $message_comment->comment }}</p>
                      </div>
                  </div>
                @endforeach
              
              @else
                <div>No Messages Yet</div>
              @endif
            
            </div>

            <div class="col-lg-4 col-md-12">
                <h3>Write a message</h3>
                <form action="{{ route('store_message') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <textarea name="message" class="form-control h-150" cols="30" rows="10" placeholder="Write your message here"></textarea>
                    </div>
                    <div class="mb-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
          @else
            <div class="col-lg-9 col-md-12">
              <a href="{{ route('message_start') }}" class="text-decoration-underline">Click here to start messaging to admin</a>
            </div>
          @endif
      </div>
  </div>
</div>
@endsection