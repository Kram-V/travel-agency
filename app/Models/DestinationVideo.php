<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationVideo extends Model
{
    protected $fillable = [
      'destination_id',
      'video'
    ];

    public function destination() {
      return $this->belongsTo(Destination::class);
    }
}
