<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDosen extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}