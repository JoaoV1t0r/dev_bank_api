<?php

namespace App\Models;

use App\Models\Account;
use App\Models\DepositPayer;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use YourAppRocks\EloquentUuid\Traits\HasUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function depositPayer(): BelongsTo
    {
        return $this->belongsTo(DepositPayer::class);
    }
}
