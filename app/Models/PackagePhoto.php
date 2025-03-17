<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagePhoto extends Model
{
    protected $fillable = [
      'package_id',
      'photo',
    ];  


    public function package() {
      return $this->belongsTo(Package::class);
    }
}
