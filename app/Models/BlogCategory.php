<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillabe = [
      'name',
      'slug'
    ];

    public function blog_posts() {
      return $this->hasMany(BlogPost::class);
    }
}
