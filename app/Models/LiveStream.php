<?php

// app/Models/LiveStream.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveStream extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'thumbnail',
        'category',
        'viewers_count',
        'is_live',
    ];

    public function host()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

