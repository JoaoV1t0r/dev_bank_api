<?php

namespace App\Domains\Users\Services\Abstract;

interface IUserPasswordResetRequestService
{
    public function requestResetPassword(string $email): bool;
}
