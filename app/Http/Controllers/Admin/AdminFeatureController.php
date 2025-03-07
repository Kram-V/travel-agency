<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class AdminFeatureController extends Controller
{
    public function index() {
      $features = Feature::all();

      return view("admin.user.features.index", compact('features'));
    }

    public function create() {
      return view("admin.user.features.create");
    }

    public function store(Request $request) {
      $request->validate([
        'icon' => 'required',
        'heading' => 'required',
        'description' => 'required',
      ]);

      $feature = new Feature();
      $feature->icon = $request->icon;
      $feature->heading = $request->heading;
      $feature->description = $request->description;
      $feature->save();

      return redirect()->route('admin_features_index')->with('success', 'Feature Added Successfully');
    }

    public function edit(Feature $feature) {
      return view("admin.user.features.edit", compact('feature'));
    }


    public function update(Request $request, Feature $feature) {
      $request->validate([
        'icon' => 'required',
        'heading' => 'required',
        'description' => 'required',
      ]);

      $feature->icon = $request->icon;
      $feature->heading = $request->heading;
      $feature->description = $request->description;
      $feature->update();

      return redirect()->route('admin_features_index')->with('success', 'Feature Updated Successfully');
    }

    public function delete( Feature $feature) {
      $feature->delete();
      return redirect()->route('admin_features_index')->with('success', 'Feature Deleted Successfully');
    }
}
