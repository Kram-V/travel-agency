<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class AdminBlogPostController extends Controller
{
    public function index() {
      $blog_posts = BlogPost::with('blog_category')->get();

      return view('admin.user.blog-posts.index', compact('blog_posts'));
    }

    public function create() {
      $blog_categories = BlogCategory::all();

      return view('admin.user.blog-posts.create', compact('blog_categories'));
    }

    public function store(Request $request) {
      $request->validate([
        'photo' => 'required|mimes:png,jpg,jpeg',
        'title'=> 'required',
        'category'=> 'required',
        'slug'=> 'required|alpha_dash|unique:blog_posts',
        'short_description'=> 'required',
        'description'=> 'required',
      ]);

      $photo = time() . '.' . $request->photo->extension();
      $request->photo->move(public_path('uploads/blog-posts'), $photo); 

      $blog_post = new BlogPost();

      $blog_post->photo = $photo;
      $blog_post->blog_category_id = $request->category;
      $blog_post->title = $request->title;
      $blog_post->slug = $request->slug;
      $blog_post->short_description = $request->short_description;
      $blog_post->description = $request->description;
      $blog_post->save();

      return redirect()->route('admin_blog_posts_index')->with('success', 'Blog Post Added Successfully');
    }

    public function edit(BlogPost $blog_post) {
      $blog_categories = BlogCategory::all();

      return view('admin.user.blog-posts.edit', compact('blog_post', 'blog_categories'));
    }

    public function update(Request $request, BlogPost $blog_post) {
      $request->validate([
        'title'=> 'required',
        'category'=> 'required',
        'slug'=> 'required|alpha_dash|unique:blog_posts,slug,' . $blog_post->id,
        'short_description'=> 'required',
        'description'=> 'required',
      ]);



      if ($request->photo) {
        $request->validate([
          'photo' => ['mimes:png,jpg,jpeg'],
        ]);

        $photo = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads/blog-posts'), $photo); 

        if ($blog_post->photo) {
          unlink(public_path('uploads/blog-posts/' . $blog_post->photo));
        }
      } else {
        $photo = null;
      }

      if ($photo) $blog_post->photo = $photo;
      $blog_post->blog_category_id = $request->category;
      $blog_post->title = $request->title;
      $blog_post->slug = $request->slug;
      $blog_post->short_description = $request->short_description;
      $blog_post->description = $request->description;
      $blog_post->save();

      return redirect()->route('admin_blog_posts_index')->with('success', 'Blog Post Updated Successfully');
    }

    public function delete(BlogPost $blog_post) {
      if ($blog_post->photo) {
        unlink(public_path('uploads/blog-posts/' . $blog_post->photo));
      }

      $blog_post->delete();

      return redirect()->back()->with('success', 'Blog Post Deleted Successfully');
    }
}
