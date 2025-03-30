@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Team Members</h1>
              <div class="ml-auto">
                <a href="{{ route('admin_team_members_create') }}"><i class="fas fa-plus"></i> Add New</a>
            </div>
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
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Designation</th> 
                                            <th>Address</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($team_members as $team_member)
                                      <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>
                                            @if (!$team_member->photo)
                                              <img src="{{ asset('images/default.png') }}" alt="Default" class="profile-photo w_100">
                                            @else
                                              <img src="{{ asset("uploads/team-members/{$team_member->photo}") }}" alt="{{ $team_member->name }}" class="profile-photo w_100">
                                            @endif
                                          </td>
                                          <td>{{ $team_member->name }}</td>
                                          <td>{{ $team_member->designation }}</td>
                                          <td>{{ $team_member->address }}</td>
                                          <td class="pt_10 pb_10">
                                              <a href="{{ route('admin_team_members_edit', $team_member->id) }}" class="btn btn-edit"><i class="fas fa-edit"></i></a>
                                              <form action="{{ route('admin_team_members_delete', $team_member->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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