@extends('front.layout.master')

@section('content')
<div class="page-top" style="background-image: url({{ asset('images/banner.jpg') }})">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>{{ $team_member->name }}</h2>
              <div class="breadcrumb-container">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                      <li class="breadcrumb-item"><a href="volunteers.html">Team Members</a></li>
                      <li class="breadcrumb-item active">Pat Flynn</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
</div>


<div class="team-single pt_70 pb_70 bg_f3f3f3">
  <div class="container">
      <div class="row">
          <div class="col-md-3">
              <div class="photo">
                  @if ($team_member->photo)
                    <img src="{{ asset('uploads/team-members/' . $team_member->photo) }}" alt="{{ $team_member->name }}">
                  @else
                    <img src="{{ asset('images/default.png') }}" alt="Default">
                  @endif
              </div>
          </div>
          <div class="col-md-9">
              <div class="table-responsive">
                  <table class="table table-bordered">
                      <tr>
                          <td>Name</td>
                          <td>{{ $team_member->name }}</td>
                      </tr>
                      <tr>
                          <td>Designation</td>
                          <td>{{ $team_member->designation }}</td>
                      </tr>
                      <tr>
                          <td>Address</td>
                          <td>{{ $team_member->address }}</td>
                      </tr>
                      <tr>
                          <td>Email Address</td>
                          <td>{{ $team_member->email_address }}</td>
                      </tr>
                      <tr>
                          <td>Phone</td>
                          <td>{{ $team_member->phone }}</td>
                      </tr>
                      <tr>
                          <td>Social Media</td>
                          <td>
                              <ul>
                                  @if ($team_member->facebook)
                                    <li><a href="{{ $team_member->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                  @endif

                                  @if ($team_member->twitter)
                                    <li><a href="{{ $team_member->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                  @endif
                           
                                  @if ($team_member->linkedin)
                                    <li><a href="{{ $team_member->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                  @endif
                               

                                  @if ($team_member->linkedin)
                                    <li><a href="{{ $team_member->linkedin }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                  @endif
                       
                              </ul>
                          </td>
                      </tr>
                  </table>
              </div>
          </div>
      
          <div class="col-md-12 mt_30">
              <h4>Biography</h4>
              <div class="description">
                {!! $team_member->biography !!}
              </div>
          </div>

      </div>
  </div>
</div>
@endsection


