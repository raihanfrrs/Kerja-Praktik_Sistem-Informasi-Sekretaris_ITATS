<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempFile extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function detail_request()
    {
        return $this->belongsTo(DetailRequest::class);
    }
}
