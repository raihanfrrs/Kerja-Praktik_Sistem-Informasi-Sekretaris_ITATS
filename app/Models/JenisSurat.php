<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Surat;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisSurat extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'jenis'
            ]
        ];
    }

    public function surat()
    {
        return $this->hasMany(Surat::class);
    }
}
