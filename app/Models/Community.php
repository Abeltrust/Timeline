<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'image',
        'moderators',
        'rules',
        'is_private',
        'created_by',
    ];

    protected $casts = [
        'moderators' => 'array',
        'is_private' => 'boolean',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'community_members');
    }

    // General posts (global feed)
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Community events
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    // Community-specific posts
    public function communityPosts()
    {
        return $this->hasMany(CommunityPost::class);
    }


    // Scopes
    public function scopePublic($query)
    {
        return $query->where('is_private', false);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Helper methods
    public function incrementMembers()
    {
        $this->increment('members_count');
    }

    public function decrementMembers()
    {
        $this->decrement('members_count');
    }
}