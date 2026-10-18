<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventClassroom extends Model
{
    protected $fillable = [
        'event_id', 'classroom_id', 'contribution_per_student', 'expected_amount'
    ];

    protected $casts = [
        'contribution_per_student' => 'decimal:2',
        'expected_amount' => 'decimal:2',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalCollectedAttribute(): float
    {
        return (float) $this->payments()->sum('amount');
    }

    public function getRemainingCollectionAttribute(): float
    {
        return (float) $this->expected_amount - $this->total_collected;
    }
}
