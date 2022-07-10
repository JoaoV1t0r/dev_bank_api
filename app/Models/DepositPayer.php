<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

/**
 * @package App\Models
 * @property int $id
 * @property string $uuid
 * @property int $account_id
 * @property float $deposit_id
 */
class DepositPayer extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'account_id',
        'deposit_id',
        'uuid',
    ];
}
