<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
      'heading',
      'description',
      'button_text',
      'button_link',
      'background_img',
    ];
}
