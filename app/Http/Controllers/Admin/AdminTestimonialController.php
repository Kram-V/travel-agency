<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AdminTestimonialController extends Controller
{
    public function index() {
      $testimonials = Testimonial::all();

      return view('admin.user.testimonials.index', compact('testimonials'));
    }

    public function create() {
      return view('admin.user.testimonials.create');
    }

    public function store(Request $request) {
      $request->validate([
        'name'=> 'required',
        'position'=> 'required',
        'company'=> 'required',
        'comment'=> 'required',
      ]);


      if ($request->photo) {
        $request->validate([
          'photo' => ['mimes:png,jpg,jpeg'],
        ]);
  
        $photo = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads/testimonials'), $photo); 
      } else {
        $photo = null;
      }

      $testimonial = new Testimonial();

      if ($photo) $testimonial->photo = $photo;
      $testimonial->name = $request->name;
      $testimonial->position = $request->position;
      $testimonial->company = $request->company;
      $testimonial->comment = $request->comment;
      $testimonial->save();

      return redirect()->route('admin_testimonials_index')->with('success', 'Testimonial Added Successfully');
    }

    public function edit(Testimonial $testimonial) {
      return view('admin.user.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial) {
      $request->validate([
        'name'=> 'required',
        'position'=> 'required',
        'company'=> 'required',
        'comment'=> 'required',
      ]);


      if ($request->photo) {
        $request->validate([
          'photo' => ['mimes:png,jpg,jpeg'],
        ]);
  
        $photo = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads/testimonials'), $photo); 

        if ($testimonial->photo) {
          unlink(public_path('uploads/testimonials/' . $testimonial->photo));
        }
      } else {
        $photo = null;
      }

      if ($photo) $testimonial->photo = $photo;
      $testimonial->name = $request->name;
      $testimonial->position = $request->position;
      $testimonial->company = $request->company;
      $testimonial->comment = $request->comment;
      $testimonial->update();

      return redirect()->route('admin_testimonials_index')->with('success', 'Testimonial Updated Successfully');
    }

    public function delete(Testimonial $testimonial) {
      if ($testimonial->photo) {
        unlink(public_path('uploads/testimonials/' . $testimonial->photo));
      }
      $testimonial->delete();

      return redirect()->back()->with('success', 'Testimonial Deleted Successfully');
    }
}
