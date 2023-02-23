<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
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
                'source' => 'role'
            ]
        ];
    }

    public function job_dosen()
    {
        return $this->hasMany(JobDosen::class);
    }

    public function job_role()
    {
        return $this->hasMany(JobRole::class);
    }
}
