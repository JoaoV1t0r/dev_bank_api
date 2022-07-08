<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Transfer extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'origin_account',
        'destination_account',
        'amount',
    ];

    public function originAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'origin_account');
    }

    public function destinationAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'destination_account');
    }
}
