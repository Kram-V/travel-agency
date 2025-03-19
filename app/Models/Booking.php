<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
      'user_id',
      'package_id',
      'package_tour_id',
      'total_person',
      'paid_amount',
      'payment_method',
      'payment_status',
      'invoice_no',
    ];

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function package() {
      return $this->belongsTo(Package::class);
    }

    public function package_tour() {
      return $this->belongsTo(PackageTour::class);
    }
}
