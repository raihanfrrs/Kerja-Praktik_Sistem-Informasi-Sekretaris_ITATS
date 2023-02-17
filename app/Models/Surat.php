<?php

namespace App\Models;

use App\Models\JenisSurat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function jenis_surat()
    {
        return $this->belongsTo(JenisSurat::class);
    }
}
