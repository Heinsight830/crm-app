<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deal extends Model
{
    protected $fillable = [
        'organization_id',
        'contact_id',
        'title',
        'stage',
        'value',
        'expected_close_date',
        'renewal_date',
        'notes',
    ];

    protected $casts = [
        'expected_close_date' => 'date',
        'renewal_date' => 'date',
    ];

    protected static function booted(): void
    {
        static::saving(function (Deal $deal) {
            if (
                $deal->renewal_date &&
                $deal->renewal_date->lessThanOrEqualTo(now()->addDays(30))
            ) {
                $deal->stage = 'renewal_due';
            }
        });
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function trainingSessions(): HasMany
    {
        return $this->hasMany(TrainingSession::class);
    }
}