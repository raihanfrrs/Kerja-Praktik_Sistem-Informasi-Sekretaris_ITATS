<?php

namespace App\Models;

use App\Models\JenisSurat;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
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

    public function jenis_surat()
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function detail_request()
    {
        return $this->hasMany(DetailRequest::class);
    }

    public function temp_request()
    {
        return $this->hasMany(TempRequest::class);
    }

    public function temp_file()
    {
        return $this->hasMany(TempFile::class);
    }
}
