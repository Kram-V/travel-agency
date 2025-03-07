<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Slider;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\WelcomeItem;

class FrontController extends Controller
{
    public function home() {
      $sliders = Slider::all();
      $welcome_item = WelcomeItem::first();
      $features = Feature::all();
      $testimonials = Testimonial::all();

      return view('front.home', compact('sliders', 'welcome_item', 'features', 'testimonials'));
    }

    public function about() {
      $welcome_item = WelcomeItem::first();

      return view('front.about', compact('welcome_item'));
    }

    public function team_members() {
      $team_members = TeamMember::all();

      return view('front.team-members', compact('team_members'));
    }

    public function team_member(TeamMember $team_member) {
      return view('front.team-member', compact('team_member'));
    }
}
