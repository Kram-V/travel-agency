<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
      'user_id',
    ];

    public function message_comments() {
      return $this->hasMany(MessageComment::class);
    }

    public function user() {
      return $this->belongsTo(User::class);
    }
}
