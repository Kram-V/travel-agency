<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
      'name',
      'email',
      'photo',
      'password',
      'phone',
      'country',
      'address',
      'state',
      'city',
      'zip',
      'token',
      'status',
    ];


    public function bookings() {
      return $this->hasMany(Booking::class);
    }

    public function reviews() {
      return $this->hasMany(Review::class);
    }

    public function messages() {
      return $this->hasMany(Message::class);
    }

    public function message_comments() {
      return $this->hasMany(MessageComment::class);
    }
}
