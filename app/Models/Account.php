<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

/**
 * @property int $id
 * @property int $user_id
 * @property int $number
 * @property string $password
 * @property float $balance
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Account extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $fillable = [
        'uuid' .
        'user_id' .
        'number' .
        'password',
        'balance',
    ];

    protected $hidden = [
        'uuid',
        'user_id',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value,
            set: fn($value) => Hash::make($value),
        );
    }


}
