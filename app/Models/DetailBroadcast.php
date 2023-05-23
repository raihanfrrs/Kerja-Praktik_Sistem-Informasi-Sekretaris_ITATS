<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBroadcast extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function broadcast()
    {
        return $this->belongsTo(Broadcast::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
