<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
      'photo',
      'name',
      'designation',
      'address',
      'phone',
      'biography',
      'facebook',
      'twitter',
      'linkedin',
      'instagram',
    ];
}
