@extends('front.layout.master')

@section('content')
<div class="page-top" style="background-image: url('images/banner.jpg')">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>Team Members</h2>
          </div>
      </div>
  </div>
</div>

<div class="team pt_70">
  <div class="container">
      <div class="row">
        @foreach ($team_members as $team_member)
        <div class="col-lg-3 col-md-6">
            <div class="item pb_50">
                <div class="photo">
                    @if ($team_member->photo)
                      <img src="{{ asset('uploads/team-members/' . $team_member->photo) }}" alt="{{ $team_member->name }}">
                    @else
                      <img src="{{ asset('images/default.png') }}" alt="Default">
                    @endif
                </div>
                <div class="text">
                    <h2><a style="text-decoration: underline;"  href="{{ route('team_member', $team_member->id) }}">{{ $team_member->name }}</a></h2>
                    <div class="designation">{{ $team_member->designation }}</div>
                    <div class="social">
                        <ul>
                          <li><a href="{{ $team_member->facebook ? $team_member->facebook : '#' }}"><i class="fab fa-facebook-f"></i></a></li>
                
                          <li><a href="{{ $team_member->twitter ? $team_member->twitter : '#' }}"><i class="fab fa-twitter"></i></a></li>

                          <li><a href="{{ $team_member->linkedin ? $team_member->linkedin : '#' }}"><i class="fab fa-linkedin-in"></i></a></li>
                  
                          <li><a href="{{ $team_member->instagram ? $team_member->instagram  : '#' }}"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
      </div>
  </div>
</div>
@endsection


