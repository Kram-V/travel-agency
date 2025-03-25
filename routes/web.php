<?php

use App\Http\Controllers\Admin\AdminAmenityController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminBlogCategoryController;
use App\Http\Controllers\Admin\AdminBlogPostController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDestinationController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminFeatureController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminTeamMemberController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminTourController;
use App\Http\Controllers\Admin\AdminWelcomeItemController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/destinations', [FrontController::class, 'destinations'])->name('destinations');
Route::get('/destinations/{slug}', [FrontController::class, 'destination'])->name('destination');
Route::get('/team-members', [FrontController::class, 'team_members'])->name('team_members');
Route::get('/team-members/{team_member}', [FrontController::class, 'team_member'])->name('team_member'); 
Route::get('/faqs', [FrontController::class, 'faqs'])->name('faqs');
Route::get('/blogs', [FrontController::class, 'blogs'])->name('blogs');
Route::get('/blogs/{slug}', [FrontController::class, 'blog'])->name('blog');
Route::get('/blogs/category/{slug}', [FrontController::class, 'blog_category'])->name('blog_category');
Route::get('/packages', [FrontController::class, 'packages'])->name('packages');
Route::get('/packages/{slug}', [FrontController::class, 'package'])->name('package');

Route::post('/send-inquiry', [FrontController::class, 'send_inquiry'])->name('send_inquiry');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/forget-password', [AuthController::class, 'forget_password'])->name('forget_password');
Route::get('/reset-password/{token}/{email}', [AuthController::class, 'reset_password'])->name('reset_password');
Route::get('/verify-email/{token}/{email}', [AuthController::class, 'verify_email'])->name('verify_email');

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
  Route::get('/message', [UserController::class, 'message'])->name('message');
  Route::get('/message-start', [UserController::class, 'message_start'])->name('message_start');
  Route::get('/profile', [UserController::class, 'profile'])->name('profile');
  Route::get('/bookings', [UserController::class, 'bookings'])->name('bookings');
  Route::get('/invoices/{invoice_no}', [UserController::class, 'invoice'])->name('invoice');
  Route::get('/reviews', [UserController::class, 'reviews'])->name('reviews');
  Route::post('/message', [UserController::class, 'store_message'])->name('store_message');
  Route::post('/profile', [UserController::class, 'update_profile'])->name('update_profile');

  Route::get('/stripe-success', [FrontController::class, 'stripe_success'])->name('stripe_success');
  Route::get('/stripe-cancel', [FrontController::class, 'stripe_cancel'])->name('stripe_cancel');
  Route::get('/paypal-success', [FrontController::class, 'paypal_success'])->name('paypal_success');
  Route::get('/paypal-cancel', [FrontController::class, 'paypal_cancel'])->name('paypal_cancel');
  Route::post('/payment', [FrontController::class, 'payment'])->name('payment');
  Route::post('/review/{package_id}/{user_id}', [FrontController::class, 'review'])->name('review');

  Route::get('/logout', [AuthController::class, 'logout_submit'])->name('logout_submit');
});

Route::post('/login', [AuthController::class, 'login_submit'])->name('login_submit');
Route::post('/register', [AuthController::class, 'register_submit'])->name('register_submit');
Route::post('/forget-password', [AuthController::class, 'forget_password_submit'])->name('forget_password_submit');
Route::post('/reset-password/{token}/{email}', [AuthController::class, 'reset_password_submit'])->name('reset_password_submit');

// ADMIN
Route::prefix('admin')->group(function () {
  Route::get('/login', [AdminAuthController::class, 'login'])->name('admin_login');
  Route::get('/forget-password', [AdminAuthController::class, 'forget_password'])->name('admin_forget_password');
  Route::get('/reset-password/{token}/{email}', [AdminAuthController::class, 'reset_password'])->name('admin_reset_password');

  Route::post('/login', [AdminAuthController::class, 'login_submit'])->name('admin_login_submit');
  Route::post('/forget-password', [AdminAuthController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
  Route::post('/reset-password/{token}/{email}', [AdminAuthController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
});

// ADMIN WITH MIDDLEWARE
Route::middleware('admin')->prefix('admin')->group(function () {
  Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin_dashboard');

  Route::get('/sliders', [AdminSliderController::class, 'index'])->name('admin_sliders_index');
  Route::get('/sliders/create', [AdminSliderController::class, 'create'])->name('admin_sliders_create');
  Route::get('/sliders/{slider}/edit', [AdminSliderController::class, 'edit'])->name('admin_sliders_edit');
  Route::post('/sliders/create', [AdminSliderController::class, 'store'])->name('admin_sliders_store');
  Route::post('/sliders/{slider}', [AdminSliderController::class, 'update'])->name('admin_sliders_update');
  Route::delete('/sliders/{slider}', [AdminSliderController::class, 'delete'])->name('admin_sliders_delete');
  
  Route::get('/profile', [AdminProfileController::class, 'profile'])->name('admin_profile');
  Route::post('/profile', [AdminProfileController::class, 'profile_submit'])->name('admin_profile_submit');

  Route::get('/welcome-item', [AdminWelcomeItemController::class, 'edit'])->name('admin_welcome_item_edit');
  Route::post('/welcome-item', [AdminWelcomeItemController::class, 'update'])->name('admin_welcome_item_update');

  Route::get('/features', [AdminFeatureController::class, 'index'])->name('admin_features_index');
  Route::get('/features/create', [AdminFeatureController::class, 'create'])->name('admin_features_create');
  Route::get('/features/{feature}/edit', [AdminFeatureController::class, 'edit'])->name('admin_features_edit');
  Route::post('/features/create', [AdminFeatureController::class, 'store'])->name('admin_features_store');
  Route::put('/features/{feature}', [AdminFeatureController::class, 'update'])->name('admin_features_update');
  Route::delete('/features/{feature}', [AdminFeatureController::class, 'delete'])->name('admin_features_delete');

  Route::get('/testimonials', [AdminTestimonialController::class, 'index'])->name('admin_testimonials_index');
  Route::get('/testimonials/create', [AdminTestimonialController::class, 'create'])->name('admin_testimonials_create');
  Route::get('/testimonials/{testimonial}/edit', [AdminTestimonialController::class, 'edit'])->name('admin_testimonials_edit');
  Route::post('/testimonials/create', [AdminTestimonialController::class, 'store'])->name('admin_testimonials_store');
  Route::post('/testimonials/{testimonial}', [AdminTestimonialController::class, 'update'])->name('admin_testimonials_update');
  Route::delete('/testimonials/{testimonial}', [AdminTestimonialController::class, 'delete'])->name('admin_testimonials_delete');

  Route::get('/team-members', [AdminTeamMemberController::class, 'index'])->name('admin_team_members_index');
  Route::get('/team-members/create', [AdminTeamMemberController::class, 'create'])->name('admin_team_members_create');
  Route::get('/team-members/{team_member}/edit', [AdminTeamMemberController::class, 'edit'])->name('admin_team_members_edit');
  Route::post('/team-members/create', [AdminTeamMemberController::class, 'store'])->name('admin_team_members_store');
  Route::post('/team-members/{team_member}', [AdminTeamMemberController::class, 'update'])->name('admin_team_members_update');
  Route::delete('/team-members/{team_member}', [AdminTeamMemberController::class, 'delete'])->name('admin_team_members_delete');

  Route::get('/faqs', [AdminFaqController::class, 'index'])->name('admin_faqs_index');
  Route::get('/faqs/create', [AdminFaqController::class, 'create'])->name('admin_faqs_create');
  Route::get('/faqs/{faq}/edit', [AdminFaqController::class, 'edit'])->name('admin_faqs_edit');
  Route::post('faqs/create', [AdminFaqController::class, 'store'])->name('admin_faqs_store');
  Route::put('faqs/{faq}', [AdminFaqController::class, 'update'])->name('admin_faqs_update');
  Route::delete('faqs/{faq}', [AdminFaqController::class, 'delete'])->name('admin_faqs_delete');

  Route::get('/blog-categories', [AdminBlogCategoryController::class, 'index'])->name('admin_blog_categories_index');
  Route::get('/blog-categories/create', [AdminBlogCategoryController::class, 'create'])->name('admin_blog_categories_create');
  Route::get('/blog-categories/{blog_category}', [AdminBlogCategoryController::class, 'edit'])->name('admin_blog_categories_edit');
  Route::post('/blog-categories/create', [AdminBlogCategoryController::class, 'store'])->name('admin_blog_categories_store');
  Route::put('/blog-categories/{blog_category}', [AdminBlogCategoryController::class, 'update'])->name('admin_blog_categories_update');
  Route::delete('/blog-categories/{blog_category}', [AdminBlogCategoryController::class, 'delete'])->name('admin_blog_categories_delete');

  Route::get("/blog-posts", [AdminBlogPostController::class, 'index'])->name('admin_blog_posts_index');
  Route::get("/blog-posts/create", [AdminBlogPostController::class, 'create'])->name('admin_blog_posts_create');
  Route::get("/blog-posts/{blog_post}/edit", [AdminBlogPostController::class, 'edit'])->name('admin_blog_posts_edit');
  Route::post("/blog-posts/create", [AdminBlogPostController::class, 'store'])->name('admin_blog_posts_store');
  Route::post("/blog-posts/{blog_post}", [AdminBlogPostController::class, 'update'])->name('admin_blog_posts_update');
  Route::delete("/blog-posts/{blog_post}", [AdminBlogPostController::class, 'delete'])->name('admin_blog_posts_delete');

  Route::get('/destinations', [AdminDestinationController::class, 'index'])->name('admin_destinations_index');
  Route::get('/destinations/create', [AdminDestinationController::class, 'create'])->name('admin_destinations_create');
  Route::get('/destinations/{destination}', [AdminDestinationController::class, 'show'])->name('admin_destinations_show');
  Route::get('/destinations/{slug}/edit', [AdminDestinationController::class, 'edit'])->name('admin_destinations_edit');
  Route::get('/destinations/{destination}/destination-photos', [AdminDestinationController::class, 'create_photo'])->name('admin_destinations_create_photo');
  Route::get('/destinations/{destination}/destination-videos', [AdminDestinationController::class, 'create_video'])->name('admin_destinations_create_video');

  Route::post('/destinations/create', [AdminDestinationController::class, 'store'])->name('admin_destinations_store');
  Route::post('/destinations/{destination}', [AdminDestinationController::class, 'update'])->name('admin_destinations_update');
  Route::post('/destination-photos/{id}', [AdminDestinationController::class, 'store_photo'])->name('admin_destinations_store_photo');
  Route::post('/destination-videos/{id}', [AdminDestinationController::class, 'store_video'])->name('admin_destinations_store_video');

  Route::delete('/destinations/{destination}', [AdminDestinationController::class, 'delete'])->name('admin_destinations_delete');
  Route::delete('/destination-photos/{destination_photo}', [AdminDestinationController::class, 'delete_photo'])->name('admin_destinations_delete_photo');
  Route::delete('/destination-videos/{destination_video}', [AdminDestinationController::class, 'delete_video'])->name('admin_destinations_delete_video');

  Route::get('/packages', [AdminPackageController::class, 'index'])->name('admin_packages_index');
  Route::get('/packages/create', [AdminPackageController::class, 'create'])->name('admin_packages_create');
  Route::get('/packages/{package}', [AdminPackageController::class, 'show'])->name('admin_packages_show');
  Route::get('/packages/{slug}/edit', [AdminPackageController::class, 'edit'])->name('admin_packages_edit');
  Route::get('/packages/{package}/package-photos', [AdminPackageController::class, 'create_photo'])->name('admin_packages_create_photo');
  Route::get('/packages/{package}/package-amenities', [AdminPackageController::class, 'create_amenity'])->name('admin_packages_create_amenity');
  Route::get('/packages/{package}/package-iteneraries', [AdminPackageController::class, 'create_itenerary'])->name('admin_packages_create_itenerary');
  Route::get('/packages/{package}/package-videos', [AdminPackageController::class, 'create_video'])->name('admin_packages_create_video');
  Route::get('/packages/{package}/package-faqs', [AdminPackageController::class, 'create_faq'])->name('admin_packages_create_faq');
  Route::post('/packages/{package}/package-amenities', [AdminPackageController::class, 'store_amenity'])->name('admin_packages_store_amenity');
  Route::post('/packages/{package}/package-iteneraries', [AdminPackageController::class, 'store_itenerary'])->name('admin_packages_store_itenerary');
  Route::post('/packages/create', [AdminPackageController::class, 'store'])->name('admin_packages_store');
  Route::post('/packages/{package}', [AdminPackageController::class, 'update'])->name('admin_packages_update');
  Route::post('/packages/{package}/package-photos', [AdminPackageController::class, 'store_photo'])->name('admin_packages_store_photo');
  Route::post('/packages/{package}/package-videos', [AdminPackageController::class, 'store_video'])->name('admin_packages_store_video');
  Route::post('/packages/{package}/package-faqs', [AdminPackageController::class, 'store_faq'])->name('admin_packages_store_faq');
  Route::delete('/packages/{package}', [AdminPackageController::class, 'delete'])->name('admin_packages_delete');
  Route::delete('/packages/package-amenities/{package_amenity}', [AdminPackageController::class, 'delete_amenity'])->name('admin_packages_delete_amenity');
  Route::delete('/packages/package-iteneraries/{package_itenerary}', [AdminPackageController::class, 'delete_itenerary'])->name('admin_packages_delete_itenerary');
  Route::delete('/packages/package-photos/{package_photo}', [AdminPackageController::class, 'delete_photo'])->name('admin_packages_delete_photo');
  Route::delete('/packages/package-videos/{package_video}', [AdminPackageController::class, 'delete_video'])->name('admin_packages_delete_video');
  Route::delete('/packages/package-faqs/{package_faq}', [AdminPackageController::class, 'delete_faq'])->name('admin_packages_delete_faq');

  Route::get('/amenities', [AdminAmenityController::class, 'index'])->name('admin_amenities_index');
  Route::get('/amenities/{amenity}/edit', [AdminAmenityController::class, 'edit'])->name('admin_amenities_edit');
  Route::get('/amenities/create', [AdminAmenityController::class, 'create'])->name('admin_amenities_create');
  Route::post('/amenities/create', [AdminAmenityController::class, 'store'])->name('admin_amenities_store');
  Route::put('/amenities/{amenity}', [AdminAmenityController::class, 'update'])->name('admin_amenities_update');
  Route::delete('/amenities/{amenity}', [AdminAmenityController::class, 'delete'])->name('admin_amenities_delete');

  Route::get('/tours', [AdminTourController::class, 'index'])->name('admin_tours_index');
  Route::get('/tours/create', [AdminTourController::class, 'create'])->name('admin_tours_create');
  Route::get('/tours/{tour}/edit', [AdminTourController::class, 'edit'])->name('admin_tours_edit');
  Route::get('/tours/{tour}/packages/{package}/bookings', [AdminTourController::class, 'tour_booking'])->name('admin_tour_booking');
  Route::get('/tours/invoices/{invoice_no}', [AdminTourController::class, 'tour_booking_invoice'])->name('admin_tour_booking_invoice');
  Route::get('/tours/bookings/{booking}', [AdminTourController::class, 'mark_complete_booking'])->name('admin_mark_complete_booking');
  Route::post('/tours/create', [AdminTourController::class, 'store'])->name('admin_tours_store');
  Route::put('/tours/{tour}', [AdminTourController::class, 'update'])->name('admin_tours_update');
  Route::delete('/tours/{tour}', [AdminTourController::class, 'delete'])->name('admin_tours_delete');

  Route::get('/reviews', [AdminReviewController::class, 'index'])->name('admin_reviews_index');

  Route::get('/user-section/messages', [AdminMessageController::class, 'messages'])->name('admin_user_section_messages');
  Route::get('/user-section/messages/details/{id}', [AdminMessageController::class, 'message_details'])->name('admin_user_section_message_details');
  Route::get('/user-section/users', [AdminMessageController::class, 'users'])->name('admin_user_section_users');
  Route::post('user-section/messages', [AdminMessageController::class, 'store_message'])->name('admin_user_section_store_message');

  Route::get('/logout', [AdminAuthController::class, 'logout_submit'])->name('admin_logout_submit');
});
