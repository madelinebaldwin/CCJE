<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = ['event_classroom_id', 'amount', 'payment_date', 'reference_no', 'remarks'];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function eventClassroom(): BelongsTo
    {
        return $this->belongsTo(EventClassroom::class);
    }
}
