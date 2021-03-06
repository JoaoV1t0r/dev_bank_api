<?php

namespace App\Domains\Users\Services\Abstract;

use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;

interface IUsersUpdateService
{
    public function userUpdate(UserUpdateRequest $request): User;
}
