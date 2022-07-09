<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

/**
 * @property int $id
 * @property int $account_id
 * @property float $amount
 * @property string $valid_until
 * @property Account $account
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Deposit extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'account_id',
        'uuid',
        'amount',
        'valid_until',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
