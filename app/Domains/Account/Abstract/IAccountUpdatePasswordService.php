<?php

namespace App\Domains\Account\Abstract;

use App\Http\Requests\Account\AccountUpdatePasswordRequest;

interface IAccountUpdatePasswordService
{
    public function updatePassword(AccountUpdatePasswordRequest $request): bool;
}
