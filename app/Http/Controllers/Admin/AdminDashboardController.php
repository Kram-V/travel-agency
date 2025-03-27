<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Subscriber;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard() { 
      $total_customers = User::get()->count();
      $total_bookings = Booking::get()->count();
      $total_blogs = BlogPost::get()->count();
      $total_packages = Package::get()->count();
      $total_destinations = Destination::get()->count();
      $total_testimonials = Testimonial::get()->count();
      $total_subscribers = Subscriber::get()->count();

      return view('admin.user.dashboard', compact('total_blogs', 'total_bookings', 'total_customers', 'total_packages', 'total_destinations', 'total_testimonials', 'total_subscribers'));
    }
}
