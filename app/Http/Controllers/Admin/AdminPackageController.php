<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Package;
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


      if ($package->featured_photo) {
        unlink(public_path('uploads/packages/' . $package->featured_photo));
      }

      $package->delete();

      return redirect()->back()->with('success', 'Package Deleted Successfully');
    }
}
