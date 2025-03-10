<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class AdminBlogCategoryController extends Controller
{
    public function index() {
      $blog_categories = BlogCategory::all();

      return view('admin.user.blog-categories.index', compact('blog_categories'));
    }

    public function create() {
      return view('admin.user.blog-categories.create');
    }

    public function store(Request $request) {
      $request->validate([
        'name' => 'required',
        'slug' => 'required|alpha_dash|unique:blog_categories',
      ]);

      $blog_category = new BlogCategory();

      $blog_category->name = $request->name;
      $blog_category->slug = $request->slug;
      $blog_category->save();

      return redirect()->route('admin_blog_categories_index')->with('success', 'Blog Category Created Successfully');
    }

    public function edit(BlogCategory $blog_category) {
      return view('admin.user.blog-categories.edit', compact('blog_category'));
    }

    public function update(Request $request, BlogCategory $blog_category) {
      $request->validate([
        'name' => 'required',
        'slug' => 'required|alpha_dash|unique:blog_categories,slug,' . $blog_category->id,
      ]);

      $blog_category->name = $request->name;
      $blog_category->slug = $request->slug;
      $blog_category->update();

      return redirect()->route('admin_blog_categories_index')->with('success', 'Blog Category Updated Successfully');
    }

    public function delete(BlogCategory $blog_category) {
      $blog_post =  BlogPost::where('blog_category_id', $blog_category->id)->first();

      if (!empty($blog_post)) {
        return redirect()->back()->with('error', 'You can\'t delete this blog category because this category is in use');
      }

      $blog_category->delete();

      return redirect()->route('admin_blog_categories_index')->with('success', 'Blog Category Deleted Successfully');
    }
}
