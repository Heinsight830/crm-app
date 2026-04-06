<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'deal_id',
        'reference',
        'amount',
        'status',
        'paid_at',
    ];

    protected static function booted(): void
    {
        static::saved(function (Payment $payment) {
            if ($payment->status === 'paid' && $payment->deal) {
                $payment->deal->update([
                    'stage' => 'training_scheduled',
                ]);
            }
        });
    }

    public function deal(): BelongsTo
    {
        return $this->belongsTo(Deal::class);
    }
}