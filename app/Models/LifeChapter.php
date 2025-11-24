<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifeChapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'period',
        'location',
        'posts_count',
        'milestones',
        'collaborators',
        'order',
    ];

    protected $casts = [
        'milestones' => 'array',
        'collaborators' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'chapter', 'title');
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}