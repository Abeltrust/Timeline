<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
    ];

    // Relationships
    public function participants()
    {
        return $this->belongsToMany(User::class, 'conversation_participants');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }

    // Helper methods
    public function getOtherParticipant($userId)
    {
        return $this->participants()->where('user_id', '!=', $userId)->first();
    }
}