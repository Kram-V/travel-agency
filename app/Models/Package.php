<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
      'destination_id',
      'featured_photo',
      'name',
      'slug',
      'description',
      'map',
      'price',
      'old_price',
    ];

    public function destination() {
      return $this->belongsTo(Destination::class);
    }

    public function package_amenities() {
      return $this->hasMany(PackageAmenity::class);
    }

    public function package_iteneraries() {
      return $this->hasMany(PackageItenerary::class);
    }

    public function package_photos() {
      return $this->hasMany(PackagePhoto::class);
    }
}
