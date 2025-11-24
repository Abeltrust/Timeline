<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'interactable_id',
        'interactable_type',
        'type',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interactable()
    {
        return $this->morphTo();
    }

    // Scopes
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeTaps($query)
    {
        return $query->where('type', 'tap');
    }

    public function scopeLockIns($query)
    {
        return $query->where('type', 'lockin');
    }

    public function scopeResonances($query)
    {
        return $query->where('type', 'resonance');
    }
}