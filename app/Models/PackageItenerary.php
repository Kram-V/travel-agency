<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageItenerary extends Model
{
    protected $fillable = [
      'package_id',
      'name',
      'description',
    ];

    public function package() {
      return $this->belongsTo(Package::class);
    }
}
