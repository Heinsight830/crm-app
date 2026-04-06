<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    protected $fillable = [
        'name',
        'industry',
        'website',
        'phone',
        'address',
        'status',
    ];

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}