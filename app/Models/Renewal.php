<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Renewal extends Model
{
    protected $fillable = [
        'organization_id',
        'contract_title',
        'renewal_due_date',
        'status',
        'renewal_amount',
        'notes',
        'reminder_30_sent',
        'reminder_90_sent',
        'reminder_150_sent',
    ];
    protected $casts = [
        'renewal_due_date' => 'date',
        'reminder_30_sent' => 'boolean',
        'reminder_90_sent' => 'boolean',
        'reminder_150_sent' => 'boolean',
        'renewal_amount' => 'decimal:2',
    ];
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
