<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRequest extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function jenis_surat()
    {
        return $this->belongsTo(JenisSurat::class);
    }
}
