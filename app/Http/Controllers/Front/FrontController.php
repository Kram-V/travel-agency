<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\DestinationPhoto;
use App\Models\DestinationVideo;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Package;
use App\Models\PackageAmenity;
use App\Models\PackageFaq;
use App\Models\PackageItenerary;
use App\Models\PackagePhoto;
use App\Models\PackageTour;
use App\Models\PackageVideo;
use App\Models\Slider;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\WelcomeItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal;

class FrontController extends Controller
{
    public function home() {
      $sliders = Slider::latest()->get();
      $welcome_item = WelcomeItem::first();
      $features = Feature::latest()->get();
      $testimonials = Testimonial::latest()->get();
      $blog_posts = BlogPost::latest()->take(3)->get();
      $destinations = Destination::latest()->take(4)->get();

      return view('front.home', compact('sliders', 'welcome_item', 'features', 'testimonials', 'blog_posts', 'destinations'));
    }

    public function about() {
      $welcome_item = WelcomeItem::first();

      return view('front.about', compact('welcome_item'));
    }

    public function destinations() {
      $destinations = Destination::latest()->get();

      return view('front.destinations', compact('destinations'));
    }

    public function destination($slug) {
      $destination = Destination::where('slug', $slug)->first();
      $destination_photos = DestinationPhoto::latest()->where('destination_id', $destination->id)->get();
      $destination_videos = DestinationVideo::latest()->where('destination_id', $destination->id)->get();

      return view('front.destination', compact('destination', 'destination_photos', 'destination_videos'));
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

    public function packages() {
      $packages = Package::latest()->get();

      return view('front.packages', compact('packages'));
    }

    public function package($slug) {
      $package = Package::with('destination')->where('slug', $slug)->first();
      $package_iteneraries = PackageItenerary::where('package_id', $package->id)->get();
      $package_amenities_included = PackageAmenity::with('amenity')->where(['package_id' => $package->id, 'type' => 'included'])->get();
      $package_amenities_excluded = PackageAmenity::with('amenity')->where(['package_id' => $package->id, 'type' => 'excluded'])->get();
      $package_photos = PackagePhoto::where('package_id', $package->id)->get();
      $package_videos = PackageVideo::where('package_id', $package->id)->get();
      $package_faqs = PackageFaq::where('package_id', $package->id)->get();
      $package_tours = PackageTour::where('package_id', $package->id)->get();


      return view(
        'front.package', 
        compact(
          'package', 
          'package_amenities_included',  
          'package_amenities_excluded', 
          'package_iteneraries', 
          'package_photos', 
          'package_videos', 
          'package_faqs',
          'package_tours'
        ));
    }

    public function send_inquiry(Request $request) {
      $request->validate([
        'full_name' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required',
        'message' => 'required',
      ]);

      $subject = 'Inquiry';
      $content = "
        <b>Full Name: </b> {$request->full_name} <br><br>
        <b>Email: </b> {$request->email} <br><br>
        <b>Phone Number: </b> {$request->phone_number} <br><br>
        <b>Message: </b> {$request->message} 
      ";
  
      Mail::to('markanthonyvivar241@gmail.com')->send(new WebsiteMail($subject, $content));

      return redirect()->back()->with('success', 'Email Sent Successfully');
    }

    public function payment(Request $request) {
      if (empty($request->package_tour_id)) return redirect()->back()->with('error', 'Please select first your tour before you make payment');

      $total_booked_seats = 0;

      $bookings = Booking::where(['package_tour_id' => $request->package_tour_id, 'package_id' =>  $request->package_id])->get();
      $package_tour = PackageTour::where('id', $request->package_tour_id)->first();

      foreach ($bookings as $booking) {  
        $total_booked_seats += $booking->total_person;
      }    
      
      $total_booked_seats += $request->total_person;

      if ($total_booked_seats > (int) $package_tour->total_seat) {
        return redirect()->back()->with('error', 'You have exceeded with total seat for the tour');
      }

      $package = Package::where('id', $request->package_id)->first();
      $total_amount = $request->ticket_price * $request->total_person;

      if ($request->payment_method === 'paypal') {
        $provider = new PayPal();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
          'intent' => 'CAPTURE',
          'application_context' => [
            'return_url' => route('paypal_success'),
            'cancel_url' => route('paypal_cancel'),
          ],
          'purchase_units' => [
            [
              'amount' => [
                'currency_code' => 'USD',
                'value' => $total_amount,
              ]
            ]
          ]
        ]); 

        if (!empty($response['id'])) {
          foreach($response['links'] as $link) {
            if ($link['rel'] == 'approve') {
              session()->put('total_person', $request->total_person);
              session()->put('package_id', $package->id);
              session()->put('package_tour_id', $request->package_tour_id);
              session()->put('user_id', Auth::guard('web')->user()->id);
              return redirect()->away($link['href']);
            }
          }
        } else {
          return redirect()->route('paypal_cancel');
        }
      } else if ($request->payment_method === 'stripe') {
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

        $response = $stripe->checkout->sessions->create([
          'line_items' => [
            [
              'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                  'name' => $package->name,
                ],
                'unit_amount' => $request->ticket_price * 100,
              ],
              'quantity' => $request->total_person,
            ]
          ],
          'mode' => 'payment',
          'success_url' => route('stripe_success') . '?session_id={CHECKOUT_SESSION_ID}',
          'cancel_url' => route('stripe_cancel'),
        ]);

        if (!empty($response->id)) {
          session()->put('paid_amount', $total_amount);
          session()->put('total_person', $request->total_person);
          session()->put('package_id', $package->id);
          session()->put('package_tour_id', $request->package_tour_id);
          session()->put('user_id', Auth::guard('web')->user()->id);

          return redirect($response->url);
        } else {
          return redirect()->route('stripe_cancel');
        }
      } else {
        $booking = new Booking();

        $booking->user_id = Auth::guard('web')->user()->id;
        $booking->package_id = $package->id;
        $booking->package_tour_id = $request->package_tour_id;
        $booking->total_person = $request->total_person;
        $booking->paid_amount = $total_amount;
        $booking->payment_method = 'cash';
        $booking->payment_status = 'PENDING';
        $booking->invoice_no = time();
        $booking->save();

        return redirect()->back()->with('success', 'Your cash payment is pending');
      }
    }

    public function paypal_success(Request $request) {
      $provider = new PayPal();
      $provider->setApiCredentials(config('paypal'));
      $provider->getAccessToken();

      $response = $provider->capturePaymentOrder($request->token);

      if (!empty($response['status']) && $response['status'] === 'COMPLETED') {
        $booking = new Booking();

        $booking->user_id = session()->get('user_id');
        $booking->package_id = session()->get('package_id');
        $booking->package_tour_id = session()->get('package_tour_id');
        $booking->total_person = session()->get('total_person');
        $booking->paid_amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
        $booking->payment_method = 'paypal';
        $booking->payment_status = $response['status'];
        $booking->invoice_no = time();
        $booking->save();

        return redirect()->back()->with('success', 'Payment Is Successful');

        unset($_SESSION['user_id']);
        unset($_SESSION['package_id']);
        unset($_SESSION['package_tour_id']);
        unset($_SESSION['total_person']);
      } else {
        return redirect()->route('paypal_cancel');
      }
    }

    public function paypal_cancel() {
      return redirect()->back()->with('error', 'Payment Is Cancelled');
    }

    public function stripe_success(Request $request) {
      if (!empty($request->session_id)) {
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
        $response = $stripe->checkout->sessions->retrieve($request->session_id);

        $booking = new Booking();

        $booking->user_id = session()->get('user_id');
        $booking->package_id = session()->get('package_id');
        $booking->package_tour_id = session()->get('package_tour_id');
        $booking->total_person = session()->get('total_person');
        $booking->paid_amount = session()->get('paid_amount');
        $booking->payment_method = 'stripe';
        $booking->payment_status = 'COMPLETED';
        $booking->invoice_no = time();
        $booking->save();

        return redirect()->back()->with('success', 'Payment Is Successful');

        unset($_SESSION['user_id']);
        unset($_SESSION['package_id']);
        unset($_SESSION['package_tour_id']);
        unset($_SESSION['total_person']);
        unset($_SESSION['paid_amount']);
      } else {
        return redirect()->route('stripe_cancel');
      }
    }

    public function stripe_cancel() {
      return redirect()->back()->with('error', 'Payment Is Cancelled');
    }
}
