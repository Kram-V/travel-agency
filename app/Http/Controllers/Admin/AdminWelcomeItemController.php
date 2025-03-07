<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WelcomeItem;
use Illuminate\Http\Request;

class AdminWelcomeItemController extends Controller
{
    public function edit() {
      $welcome_item = WelcomeItem::all()[0];

      return view('admin.user.welcome-item.index', compact('welcome_item'));
    }

    public function update(Request $request) {
      $request->validate([
        'heading' => 'required',
        'description' => 'required',
        'video_id' => 'required',
      ]);

      $welcome_item = WelcomeItem::first();
  

      if ($request->hasFile('photo')) {
        $request->validate([
          'photo' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $photo = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads/welcome-item'), $photo); 
     
        unlink(public_path('uploads/welcome-item/' . $welcome_item->photo));
      } else {
        $photo = '';
      }
 

      if ($photo) $welcome_item->photo = $photo;
      $welcome_item->heading = $request->heading;
      $welcome_item->video_id = $request->video_id;
      $welcome_item->button_text = $request->button_text;
      $welcome_item->button_link = $request->button_link;
      $welcome_item->description = $request->description;
      $welcome_item->update();

      return redirect()->back()->with('success', 'Data Updated Successfully');
    }
} 
