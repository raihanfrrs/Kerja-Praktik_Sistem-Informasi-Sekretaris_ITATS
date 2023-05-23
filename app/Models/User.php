<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [
        'id'  
    ];

    protected $fillable = [
        'username',
        'password',
        'level',
    ];

    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    public function otp()
    {
        return $this->hasOne(Otp::class);
    }

    public function temp_request()
    {
        return $this->hasOne(TempRequest::class);
    }

    public function request()
    {
        return $this->hasOne(Request::class);
    }

    public function broadcast()
    {
        return $this->hasMany(Broadcast::class);
    }

    public function temp_broadcast()
    {
        return $this->hasMany(TempBroadcast::class);
    }

    public function temp_dosen()
    {
        return $this->hasMany(TempDosen::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
