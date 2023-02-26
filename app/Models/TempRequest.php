<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempRequest extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
