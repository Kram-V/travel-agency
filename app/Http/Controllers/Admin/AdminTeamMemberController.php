<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class AdminTeamMemberController extends Controller
{
    public function index() {
      $team_members = TeamMember::all();

      return view("admin.user.team-members.index", compact('team_members'));
    }

    public function create() {
      return view("admin.user.team-members.create");
    }

    public function store(Request $request) {
      $request->validate([
        'name' => 'required',
        'email_address' => 'required|email',
        'designation' => 'required',
        'address' => 'required',
        'phone' => 'required',
        'biography' => 'required',
      ]);

      if ($request->photo) {
        $request->validate([
          'photo' => ['mimes:png,jpg,jpeg'],
        ]);
  
        $photo = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads/team-members'), $photo); 
      } else {
        $photo = '';
      }

      $team_member = new TeamMember();

      if ($photo) $team_member->photo = $photo;
      $team_member->name = $request->name;
      $team_member->email_address = $request->email_address;
      $team_member->designation = $request->designation;
      $team_member->address = $request->address;
      $team_member->phone = $request->phone;
      $team_member->biography = $request->biography;
      $team_member->facebook = $request->facebook ?? null;
      $team_member->twitter = $request->twitter ?? null;
      $team_member->linkedin = $request->linkedin ?? null;
      $team_member->instagram = $request->instagram ?? null;
      $team_member->save();

      return redirect()->route('admin_team_members_index')->with('success', 'Team Member Added Successfully');
    }

    public function edit(TeamMember $team_member) {
      return view('admin.user.team-members.edit', compact('team_member'));
    }

    public function update(Request $request, TeamMember $team_member) {
      $request->validate([
        'name' => 'required',
        'email_address' => 'required|email',
        'designation' => 'required',
        'address' => 'required',
        'phone' => 'required',
        'biography' => 'required',
      ]);

      if ($request->photo) {
        $request->validate([
          'photo' => ['mimes:png,jpg,jpeg'],
        ]);
  
        $photo = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads/team-members'), $photo); 

        if ($team_member->photo) {
          unlink(public_path('uploads/team-members/' . $team_member->photo));
        } 
      } else {
        $photo = '';
      }

      if ($photo) $team_member->photo = $photo;
      $team_member->name = $request->name;
      $team_member->email_address = $request->email_address;
      $team_member->designation = $request->designation;
      $team_member->address = $request->address;
      $team_member->phone = $request->phone;
      $team_member->biography = $request->biography;
      $team_member->facebook = $request->facebook ?? null;
      $team_member->twitter = $request->twitter ?? null;
      $team_member->linkedin = $request->linkedin ?? null;
      $team_member->instagram = $request->instagram ?? null;
      $team_member->update();

      return redirect()->route('admin_team_members_index')->with('success', 'Team Member Updated Successfully');
    }

    public function delete(TeamMember $team_member) {
      if ($team_member->photo) {
        unlink(public_path('uploads/team-members/' . $team_member->photo));
      }

      $team_member->delete();

      return redirect()->route('admin_team_members_index')->with('success', 'Team Member Deleted Successfully');
    }
}
