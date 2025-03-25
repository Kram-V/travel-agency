<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageComment extends Model
{
    protected $fillable = [
      'message_id',
      'sender_id',
      'type',
      'comment',
    ];

    public function message() {
      return $this->belongsTo(Message::class);
    }

    public function sender_admin() {
      return $this->belongsTo(Admin::class,'sender_id', 'id');
    }

    public function sender_non_admin() {
      return $this->belongsTo(User::class, 'sender_id', 'id');
    }
}
