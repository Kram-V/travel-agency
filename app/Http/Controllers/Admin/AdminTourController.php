<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use App\Models\PackageTour;
use Illuminate\Http\Request;

class AdminTourController extends Controller
{
    public function index() {
      $package_tours = PackageTour::with('package')->latest()->get();

      return view('admin.user.tours.index', compact('package_tours'));
    }

    public function create() {
      $packages = Package::latest()->get();

      return view('admin.user.tours.create', compact('packages')); 
    }

    public function store(Request $request) {
      $request->validate([
        'package' => 'required',
        'total_seat' => 'required|numeric|min:1',
        'tour_start_date' => 'required',
        'tour_end_date' => 'required',
        'booking_end_date' => 'required',
      ]);

      $tour = new PackageTour();

      $tour->package_id = $request->package;
      $tour->tour_start_date = $request->tour_start_date;
      $tour->tour_end_date = $request->tour_end_date;
      $tour->booking_end_date = $request->booking_end_date;
      $tour->total_seat = $request->total_seat;
      $tour->save();

      return redirect()->route('admin_tours_index')->with('success', 'Tour Added Successfully');
    }

    public function edit(PackageTour $tour) {
      $packages = Package::latest()->get();

      return view('admin.user.tours.edit', compact('tour', 'packages'));
    }

    public function update(Request $request, PackageTour $tour) {
      $request->validate([
        'package' => 'required',
        'total_seat' => 'required|numeric|min:1',
        'tour_start_date' => 'required',
        'tour_end_date' => 'required',
        'booking_end_date' => 'required',
      ]);

      $tour->package_id = $request->package;
      $tour->tour_start_date = $request->tour_start_date;
      $tour->tour_end_date = $request->tour_end_date;
      $tour->booking_end_date = $request->booking_end_date;
      $tour->total_seat = $request->total_seat;
      $tour->update();

      return redirect()->route('admin_tours_index')->with('success', 'Tour Updated Successfully');
    }

    public function delete(PackageTour $tour) {
      $tour->delete();

      return redirect()->route('admin_tours_index')->with('success', 'Tour Deleted Successfully');
    }

    public function tour_booking(PackageTour $tour, Package $package) {
      $tour_bookings = Booking::with('user')->where(['package_id' => $package->id, 'package_tour_id' => $tour->id])->get();

      return view('admin.user.tours.booking-details', compact('tour_bookings'));
    }
}
