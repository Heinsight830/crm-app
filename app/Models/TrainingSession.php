<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingSession extends Model
{
    protected $fillable = [
        'deal_id',
        'title',
        'session_date',
        'trainer_name',
        'status',
        'notes',
    ];

    protected static function booted(): void
    {
        static::saved(function (TrainingSession $trainingSession) {
            if ($trainingSession->status === 'completed' && $trainingSession->deal) {
                $trainingSession->deal->update([
                    'stage' => 'active',
                ]);
            }
        });
    }

    public function deal(): BelongsTo
    {
        return $this->belongsTo(Deal::class);
    }
}