<?php

namespace App\Infra\Database\Repositories\Abstract;

use App\Models\User;

interface IUserRepository
{
    public function save(User $user): User;

    public function update(User $user): User;

    public function delete(User $user): User;
}
