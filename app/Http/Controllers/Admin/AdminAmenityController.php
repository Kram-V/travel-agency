<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\PackageAmenity;
use Illuminate\Http\Request;

class AdminAmenityController extends Controller
{
    public function index() {
      $amenities = Amenity::latest()->get();

      return view('admin.user.amenities.index', compact('amenities'));
    }

    public function create() {
      return view('admin.user.amenities.create');
    }

    public function store(Request $request) {
      $request->validate([
        'name' => 'required',
      ]);

      $amenity = new Amenity();

      $amenity->name = $request->name;
      $amenity->save();

      return redirect()->route('admin_amenities_index')->with('success', 'Amenity Created Successfully');
    }

    public function edit(Amenity $amenity) {
      return view('admin.user.amenities.edit', compact('amenity'));
    }

    public function update(Request $request, Amenity $amenity) {
      $request->validate([
        'name' => 'required',
      ]);

      $amenity->name = $request->name;
      $amenity->update();

      return redirect()->route('admin_amenities_index')->with('success', 'Amenity Updated Successfully');
    }

    public function delete(Amenity $amenity) {
      $package_amenity = PackageAmenity::where('amenity_id', $amenity->id)->first();

      if (!empty($package_amenity)) {
        return redirect()->back()->with('error', 'You can\'t delete this because this data is in use with other data');
      }

      $amenity->delete();
      
      return redirect()->route('admin_amenities_index')->with('success', 'Amenity Deleted Successfully');
    }
}
