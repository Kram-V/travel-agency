<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageTour extends Model
{
    protected $fillabe = [
      'package_id',
      'tour_start_date',
      'tour_end_date',
      'booking_end_date',
      'total_seat',
    ];

    public function package() {
      return $this->belongsTo(Package::class);
    }

    public function bookings() {
      return $this->hasMany(Booking::class);
    }
}
