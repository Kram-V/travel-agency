<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageAmenity extends Model
{
    protected $fillable = [
      'package_id',
      'amenity_id',
      'type',
    ];

    public function package() {
      return $this->belongsTo(Package::class);
    }

    public function amenity() {
      return $this->belongsTo(Amenity::class);
    }
}
