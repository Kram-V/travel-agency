<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Slider;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\WelcomeItem;

class FrontController extends Controller
{
    public function home() {
      $sliders = Slider::latest()->get();
      $welcome_item = WelcomeItem::first();
      $features = Feature::latest()->get();
      $testimonials = Testimonial::latest()->get();
      $blog_posts = BlogPost::latest()->take(3)->get();

      return view('front.home', compact('sliders', 'welcome_item', 'features', 'testimonials', 'blog_posts'));
    }

    public function about() {
      $welcome_item = WelcomeItem::first();

      return view('front.about', compact('welcome_item'));
    }

    public function team_members() {
      $team_members = TeamMember::latest()->get();

      return view('front.team-members', compact('team_members'));
    }

    public function team_member(TeamMember $team_member) {
      return view('front.team-member', compact('team_member'));
    }

    public function faqs() {
      $faqs = Faq::latest()->get();

      return view('front.faq', compact('faqs'));
    }

    public function blogs() {
      $blog_posts = BlogPost::with('blog_category')->latest()->paginate(6);

      return view('front.blogs', compact('blog_posts'));
    }

    public function blog($slug) {
      $blog_post = BlogPost::with('blog_category')->where('slug', $slug)->first();
      $latest_blog_posts = BlogPost::latest()->take(3)->get();
      $categories = BlogCategory::orderBy('name', 'asc')->get();

      return view('front.blog', compact('blog_post', 'latest_blog_posts', 'categories'));
    }

    public function blog_category($slug) {
      $blog_category = BlogCategory::where('slug', $slug)->first();
      $blog_posts = BlogPost::with('blog_category')->where('blog_category_id', $blog_category->id)->latest()->paginate(6);

      return view('front.blog-category', compact('blog_category', 'blog_posts'));
    }
}
