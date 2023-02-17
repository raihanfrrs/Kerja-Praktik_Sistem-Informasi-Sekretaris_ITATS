<?php

namespace App\Models;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
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
