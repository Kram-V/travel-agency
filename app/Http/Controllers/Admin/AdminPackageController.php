<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Destination;
use App\Models\Package;
use App\Models\PackageAmenity;
use App\Models\PackageFaq;
use App\Models\PackageItenerary;
use App\Models\PackagePhoto;
use App\Models\PackageTour;
use App\Models\PackageVideo;
use App\Models\Review;
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
      $package_amenity = PackageAmenity::where('package_id', $package->id)->first();
      $package_itenerary = PackageItenerary::where('package_id', $package->id)->first();
      $package_photo = PackagePhoto::where('package_id', $package->id)->first();
      $package_video = PackageVideo::where('package_id', $package->id)->first();
      $package_tour = PackageTour::where('package_id', $package->id)->first();
      $review = Review::where('package_id', $package->id)->first();

      if (!empty($package_amenity) || !empty($package_itenerary) || !empty($package_photo) || !empty($package_video) || !empty($package_tour) || !empty($review)) {
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

    
    public function create_itenerary(Package $package) {
      $package_iteneraries = PackageItenerary::where('package_id', $package->id)->get();

      return view('admin.user.packages.create-itenerary', compact('package_iteneraries', 'package'));
    }

    public function store_itenerary(Request $request, Package $package) {
      $request->validate([
        'name' => 'required',
        'description' => 'required',
      ]);

      $package_itenerary = new PackageItenerary();
      $package_itenerary->package_id = $package->id;
      $package_itenerary->name = $request->name;
      $package_itenerary->description = $request->description; 
      $package_itenerary->save();

      return redirect()->back()->with('success', 'Itenerary Added Successfully');
    }

    public function delete_itenerary(PackageItenerary $package_itenerary) {
      $package_itenerary->delete();

      return redirect()->back()->with('success', 'Itenerary Deleted Successfully');
    }

    public function create_photo(Package $package) {
      $package_photos = PackagePhoto::where('package_id', $package->id)->latest()->get();

      return view('admin.user.packages.create-photo', compact('package', 'package_photos'));
    }

    public function store_photo(Request $request, Package $package) {
      $request->validate([
        'photo' => 'required|mimes:png,jpg,jpeg',
      ]);

 
      $photo = time() . '.' . $request->photo->extension();
      $request->photo->move(public_path('uploads/package-photos'), $photo); 

      $package_photo = new PackagePhoto();

      $package_photo->package_id = $package->id;
      $package_photo->photo = $photo;
      $package_photo->save();

      return redirect()->back()->with('success', 'Photo Added Successfully');
    }

    public function delete_photo(PackagePhoto $package_photo) {

      unlink(public_path('uploads/package-photos/' . $package_photo->photo));
      $package_photo->delete();

      return redirect()->back()->with('success', 'Amenity Deleted Successfully');
    }

    public function create_video(Package $package) {
      $package_videos = PackageVideo::latest()->where('package_id', $package->id)->get();

      return view('admin.user.packages.create-video', compact('package', 'package_videos'));
    }

    public function store_video(Request $request, Package $package) {
      $request->validate([
        'video' => 'required'
      ]);

      $package_video = new PackageVideo();

      $package_video->package_id = $package->id;
      $package_video->video = $request->video;
      $package_video->save();

      return redirect()->back()->with('success', 'Package Video Created Successfully');
    }

    public function delete_video(PackageVideo $package_video) {
      $package_video->delete();

      return redirect()->back()->with('success', 'Video Deleted Successfully');
    }

    public function create_faq(Package $package) {
      $package_faqs = PackageFaq::latest()->where('package_id', $package->id)->get();

      return view('admin.user.packages.create-faq', compact('package', 'package_faqs'));
    }

    public function store_faq(Request $request, Package $package) {
      $request->validate([
        'question' => 'required',
        'answer' => 'required',
      ]);

      $package_faq = new PackageFaq();

      $package_faq->package_id = $package->id;
      $package_faq->question = $request->question;
      $package_faq->answer = $request->answer;
      $package_faq->save();

      return redirect()->back()->with('success', 'Package Faq Created Successfully');
    }

    public function delete_faq(PackageFaq $package_faq) {
      $package_faq->delete();

      return redirect()->back()->with('success', 'FAQ Deleted Successfully');
    }
}
