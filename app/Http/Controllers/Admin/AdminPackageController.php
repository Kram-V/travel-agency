<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Destination;
use App\Models\Package;
use App\Models\PackageAmenity;
use Illuminate\Http\Request;

class AdminPackageController extends Controller
{
    public function index() {
      $packages = Package::latest()->get();

      return view('admin.user.packages.index', compact('packages'));
    }

    public function create() {
      $destinations = Destination::orderBy('name', 'asc')->get();

      return view('admin.user.packages.create', compact('destinations'));
    }

    public function show(Package $package) {
      return view('admin.user.packages.show', compact('package'));
    }

    public function store(Request $request) {
      $request->validate([
        'featured_photo'=> 'required|mimes:png,jpg,jpeg',
        'name'=> 'required',
        'slug'=> 'required|alpha_dash|unique:packages',
        'destination'=> 'required',
        'price'=> 'required|numeric|min:0',
        'old_price' => 'numeric|min:0',
        'map'=> 'required',
        'description'=> 'required',
      ]);

      $photo = time() . '.' . $request->featured_photo->extension();
      $request->featured_photo->move(public_path('uploads/packages'), $photo); 
    
      $package = new Package();

      $package->featured_photo = $photo;
      $package->name = $request->name;
      $package->slug = $request->slug;
      $package->destination_id = $request->destination;
      $package->price = $request->price;
      if ($request->old_price) $package->old_price = $request->old_price;
      $package->map = $request->map;
      $package->description = $request->description;
      $package->save();

      return redirect()->route('admin_packages_index')->with('success', 'Package Added Successfully');
    }

    public function edit($slug) {
      $package = Package::where('slug', $slug)->first();
      $destinations = Destination::orderBy('name', 'asc')->get();

      return view('admin.user.packages.edit', compact('package',  'destinations'));
    }

    public function update(Request $request, Package $package) {
      $request->validate([
        'name'=> 'required',
        'slug'=> 'required|alpha_dash|unique:packages,slug,' . $package->id,
        'destination'=> 'required',
        'price'=> 'required|numeric|min:0',
        'old_price'=> 'numeric|min:0',
        'map'=> 'required',
        'description'=> 'required',
      ]);

      
      if ($request->featured_photo) {
        $request->validate([
          'featured_photo' => ['mimes:png,jpg,jpeg'],
        ]);

        $photo = time() . '.' . $request->featured_photo->extension();
        $request->featured_photo->move(public_path('uploads/packages'), $photo); 

        if ($package->featured_photo) {
          unlink(public_path('uploads/packages/' . $package->featured_photo));
        }
      } else {
        $photo = null;
      }

      if ($photo) $package->featured_photo = $photo;
      $package->name = $request->name;
      $package->slug = $request->slug;
      $package->destination_id = $request->destination;
      $package->price = $request->price;
      if ($request->old_price) $package->old_price = $request->old_price;
      $package->map = $request->map;
      $package->description = $request->description;
      $package->save();

      return redirect()->route('admin_packages_index')->with('success', 'Package Updated Successfully');
    }

    public function delete(Package $package) {
      // $destination_photo = DestinationPhoto::where('destination_id', $destination->id)->first();
      // $destination_video = DestinationVideo::where('destination_id', $destination->id)->first();

      // if (!empty($destination_photo) || !empty($destination_video)) {
      //   return redirect()->back()->with('error', 'Can\'t delete this because the data id is in use');
      // }

      $package_amenity = PackageAmenity::where('package_id', $package->id)->first();

      if (!empty($package_amenity)) {
        return redirect()->back()->with('error', 'You can\'t delete this data because it is in use with other data');
      }

      if ($package->featured_photo) {
        unlink(public_path('uploads/packages/' . $package->featured_photo));
      }

      $package->delete();

      return redirect()->back()->with('success', 'Package Deleted Successfully');
    }

    public function create_amenity(Package $package) {
      $amenities = Amenity::latest()->get();
      $package_amenities = PackageAmenity::with('amenity')->where('package_id', $package->id)->latest()->get();

      return view('admin.user.packages.create-amenity', compact('package', 'amenities', 'package_amenities'));
    }

    public function store_amenity(Request $request, Package $package) {
      $request->validate([
        'amenity' => 'required',
        'type' => 'required',
      ]);

      $count = PackageAmenity::where(['package_id' => $package->id, 'amenity_id' => $request->amenity])->count();

      if ($count > 0) {
        return redirect()->back()->with('error', 'You have already created this amenity')->withInput();
      }

      $package_amenity = new PackageAmenity();
      $package_amenity->package_id = $package->id;
      $package_amenity->amenity_id = $request->amenity;
      $package_amenity->type = $request->type;
      $package_amenity->save();

      return redirect()->back()->with('success', 'Amenity Added Successfully');
    }

    public function delete_amenity(PackageAmenity $package_amenity) {
      $package_amenity->delete();

      return redirect()->back()->with('success', 'Amenity Deleted Successfully');
    }
}
