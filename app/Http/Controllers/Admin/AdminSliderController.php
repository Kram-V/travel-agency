<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class AdminSliderController extends Controller
{
    public function index() {
      $sliders = Slider::all();

      return view('admin.user.sliders.index', compact('sliders'));
    }

    public function create() {
      return view('admin.user.sliders.create');
    }

    public function store(Request $request) {
      $request->validate([
        'background_img' => 'required|image|mimes:png,jpg,jpeg',
        'heading' => 'required',
        'description' => 'required',
      ]);

      $photo = time() . '.' . $request->background_img->extension();
      $request->background_img->move(public_path('uploads/sliders'), $photo);

      $slider = new Slider();
      $slider->heading = $request->heading;
      $slider->description = $request->description;
      $slider->button_text = $request->button_text;
      $slider->button_link = $request->button_link;
      $slider->background_img = $photo;
      $slider->save();

      return redirect()->route('admin_sliders_index')->with('success', 'Slider Created Successfully');
    } 

    public function edit(Slider $slider) {
      return view('admin.user.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider) {
      $request->validate([
        'heading' => 'required',
        'description' => 'required',
      ]);

      $photo = null;

      if ($request->background_img) {
        $request->validate([
          'background_img' => 'mimes:png,jpg,jpeg',
        ]);

        $photo = time() . '.' . $request->background_img->extension();
        $request->background_img->move(public_path('uploads/sliders'), $photo);
        unlink(public_path('uploads/sliders/' . $slider->background_img));
      }

      $slider->heading = $request->heading;
      $slider->description = $request->description;
      $slider->button_text = $request->button_text;
      $slider->button_link = $request->button_link;
      if($photo) $slider->background_img = $photo;
      $slider->update();

      return redirect()->route('admin_sliders_index')->with('success', 'Slider Updated Successfully');
    }

    public function delete(Slider $slider) {
      unlink(public_path('uploads/sliders/' . $slider->background_img));
      $slider->delete();

      return redirect()->back()->with('success', 'Slider Deleted Successfully');
    }
}
