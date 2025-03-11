<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminBlogCategoryController;
use App\Http\Controllers\Admin\AdminBlogPostController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDestinationController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminFeatureController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminTeamMemberController;
use App\Http\Controllers\Admin\AdminTestimonialController;
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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/forget-password', [AuthController::class, 'forget_password'])->name('forget_password');
Route::get('/reset-password/{token}/{email}', [AuthController::class, 'reset_password'])->name('reset_password');
Route::get('/verify-email/{token}/{email}', [AuthController::class, 'verify_email'])->name('verify_email');

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
  Route::get('/profile', [UserController::class, 'profile'])->name('profile');

  Route::post('/profile', [UserController::class, 'update_profile'])->name('update_profile');

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

  Route::post('/destinations/create', [AdminDestinationController::class, 'store'])->name('admin_destinations_store');
  Route::post('/destinations/{destination}', [AdminDestinationController::class, 'update'])->name('admin_destinations_update');

  Route::delete('/destinations/{destination}', [AdminDestinationController::class, 'delete'])->name('admin_destinations_delete');

  Route::get('/logout', [AdminAuthController::class, 'logout_submit'])->name('admin_logout_submit');
});
