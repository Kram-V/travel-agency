<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index() {
      $reviews = Review::with(['user', 'package'])->latest()->get();

      return view('admin.user.reviews.index', compact('reviews'));
    }
}
