<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id'
    ];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail_request()
    {
        return $this->hasMany(DetailRequest::class);
    }

    public function detail_broadcast()
    {
        return $this->hasMany(DetailBroadcast::class);
    }

    public function temp_dosen()
    {
        return $this->hasMany(TempDosen::class);
    }
}
