<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
      'featured_photo',
      'name',
      'slug',
      'description',
      'country',
      'visa_requirement',
      'language',
      'currency',
      'area',
      'timezone',
      'best_time',
      'health_and_safety',
      'view_count',
      'map',
    ];

    public function destination_photos() {
      return $this->hasMany(DestinationPhoto::class);
    }
}
