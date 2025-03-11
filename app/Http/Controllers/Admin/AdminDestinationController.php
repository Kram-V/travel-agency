<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class AdminDestinationController extends Controller
{
    public function index() {
      $destinations = Destination::latest()->get();

      return view('admin.user.destinations.index', compact('destinations'));
    }

    public function create() {
      return view('admin.user.destinations.create');
    }

    
    public function show(Destination $destination) {
      return view('admin.user.destinations.show', compact('destination'));
    }

    public function store(Request $request) {
      $request->validate([
        'featured_photo'=> 'required|mimes:png,jpg,jpeg',
        'name'=> 'required',
        'slug'=> 'required|alpha_dash|unique:destinations',
        'country'=> 'required',
        'visa_requirement'=> 'required',
        'language'=> 'required',
        'activity'=> 'required',
        'currency'=> 'required',
        'area'=> 'required',
        'timezone'=> 'required',
        'health_and_safety'=> 'required',
        'best_time'=> 'required',
        'map'=> 'required',
        'description'=> 'required',
      ]);

      $photo = time() . '.' . $request->featured_photo->extension();
      $request->featured_photo->move(public_path('uploads/destinations'), $photo); 
    
      $destination = new Destination();

      $destination->featured_photo = $photo;
      $destination->name = $request->name;
      $destination->slug = $request->slug;
      $destination->country = $request->country;
      $destination->visa_requirement = $request->visa_requirement;
      $destination->language = $request->language;
      $destination->activity = $request->activity;
      $destination->currency = $request->currency;
      $destination->area = $request->area;
      $destination->timezone = $request->timezone;
      $destination->health_and_safety = $request->health_and_safety;
      $destination->best_time = $request->best_time;
      $destination->map = $request->map;
      $destination->description = $request->description;
      $destination->save();

      return redirect()->route('admin_destinations_index')->with('success', 'Destination Added Successfully');
    }

    public function edit($slug) {
      $destination = Destination::where('slug', $slug)->first();

      return view('admin.user.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination) {
      $request->validate([
        'name'=> 'required',
        'slug'=> 'required|alpha_dash|unique:destinations,slug,' . $destination->id,
        'country'=> 'required',
        'visa_requirement'=> 'required',
        'language'=> 'required',
        'activity'=> 'required',
        'currency'=> 'required',
        'area'=> 'required',
        'timezone'=> 'required',
        'health_and_safety'=> 'required',
        'best_time'=> 'required',
        'map'=> 'required',
        'description'=> 'required',
      ]);

      
      if ($request->featured_photo) {
        $request->validate([
          'featured_photo' => ['mimes:png,jpg,jpeg'],
        ]);
  
        $photo = time() . '.' . $request->featured_photo->extension();
        $request->featured_photo->move(public_path('uploads/destinations'), $photo); 

        if ($destination->featured_photo) {
          unlink(public_path('uploads/destinations/' . $destination->featured_photo));
        }
      } else {
        $photo = null;
      }

      if ($photo) $destination->featured_photo = $photo;
      $destination->name = $request->name;
      $destination->slug = $request->slug;
      $destination->country = $request->country;
      $destination->visa_requirement = $request->visa_requirement;
      $destination->language = $request->language;
      $destination->activity = $request->activity;
      $destination->currency = $request->currency;
      $destination->area = $request->area;
      $destination->timezone = $request->timezone;
      $destination->health_and_safety = $request->health_and_safety;
      $destination->best_time = $request->best_time;
      $destination->map = $request->map;
      $destination->description = $request->description;
      $destination->update();

      return redirect()->route('admin_destinations_index')->with('success', 'Destination Updated Successfully');
    }

    public function delete(Destination $destination) {
      if ($destination->featured_photo) {
        unlink(public_path('uploads/destinations/' . $destination->featured_photo));
      }

      $destination->delete();

      return redirect()->back()->with('success', 'Destination Deleted Successfully');
    }
}
