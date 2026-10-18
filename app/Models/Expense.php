<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    protected $fillable = [
        'event_id', 'category', 'description', 'quantity',
        'unit_cost', 'amount', 'expense_date', 'receipt_reference', 'remarks'
    ];

    protected $casts = [
        'expense_date' => 'date',
        'unit_cost' => 'decimal:2',
        'amount' => 'decimal:2',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
