@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Messages from {{ $message->user->name }}</h1>
              <div class="ml-auto">
                <a href="{{ route('admin_messages_index') }}" class="btn btn-primary">Back to listing</a>
            </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-12">
                    <div class="row">
                      <div class="card col-{{ count($message_comments) > 0 ? '7' : '12' }}">
                          <div class="card-body">
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
                                            <h4>
                                              {{ $message_comment->type === 'customer' ?  $message_comment->sender_non_admin->name : $message_comment->sender_admin->name }}
                                            </h4>
                                            <h5>
                                              {{ ucfirst($message_comment->type) }}
                                        
                                            </h5>
                                            <div class="date-time">
                                              {{ $message_comment->created_at->format('Y-m-d h:i:s A') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="message-bottom">
                                        <p>
                                          {{ $message_comment->comment }}
                                        </p>
                                    </div>
                                </div>
                              @endforeach
                            @else
                              <h5 class="text-center">No Messages Yet</h5>
                            @endif
                          </div>
                      </div>

                      @if (count($message_comments) > 0)
                        <div class="card col-5">
                          <div class="card-body">
                            <form action="{{ route('admin_messages_store_message') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $message->id }}" name="message_id">
                                <input type="hidden" value="{{ $message->user->email }}" name="customer_email">
                                <div class="mb-2">
                                    <textarea name="message" class="form-control h_150" cols="30" rows="10" placeholder="Write your message here"></textarea>
                                </div>
                                <div class="mb-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
              </div>
          </div>
      </section>
  </div>
@endsection