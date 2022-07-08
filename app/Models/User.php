<?php

namespace App\Models;

use App\Support\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

/**
 * App\Models\User
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $email
 * @property string $cpf
 * @property string $rg
 * @property string $phone
 * @property string|null $email_verified_at
 * @property string $password
 * @property boolean $is_active
 * @property UserRoleEnum $role
 * @property string|null $remember_token
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasUuid, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'phone',
        'email',
        'cpf',
        'rg',
        'role',
        'password',
        'email_verified_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => UserRoleEnum::class,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'uuid',
        'email_verified_at',
        'password',
        'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(RegistrationRequest::class);
    }

    public function account(): HasOne
    {
        return $this->hasOne(Account::class);
    }
}
