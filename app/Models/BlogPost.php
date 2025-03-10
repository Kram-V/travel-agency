<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
      'blog_category_id',
      'title',
      'slug',
      'short_description',
      'description',
      'photo',
    ];  

    public function blog_category() {
      return $this->belongsTo(BlogCategory::class);
    }
}
