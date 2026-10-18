<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'name', 'event_date', 'location', 'description',
        'approved_budget', 'status', 'academic_year'
    ];

    protected $casts = [
        'event_date' => 'date',
        'approved_budget' => 'decimal:2',
    ];

    public function eventClassrooms(): HasMany
    {
        return $this->hasMany(EventClassroom::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function getTotalExpensesAttribute(): float
    {
        return (float) $this->expenses()->sum('amount');
    }

    public function getRemainingBudgetAttribute(): float
    {
        return (float) $this->approved_budget - $this->total_expenses;
    }
}
