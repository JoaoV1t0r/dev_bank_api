<?php

namespace App\Domains\Users\Services\Abstract;

use App\Http\Requests\User\UserResetPasswordRequest;

interface IUserPasswordResetService
{
    public function resetPassword(UserResetPasswordRequest $request): bool;
}
