<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageVideo extends Model
{
    protected $fillable = [
      'package_id',
      'video',
    ];

    public function package() {
      return $this->belongsTo(Package::class);
    }
}
