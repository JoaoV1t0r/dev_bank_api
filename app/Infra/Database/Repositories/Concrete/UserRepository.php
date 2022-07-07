<?php

namespace App\Infra\Database\Repositories\Concrete;

use App\Exceptions\HttpInternalErrorException;
use App\Exceptions\SystemDefaultException;
use App\Infra\Database\Repositories\Abstract\IUserRepository;
use App\Infra\Database\Repositories\RepositoryBase;
use App\Models\User;

class UserRepository extends RepositoryBase implements IUserRepository
{
    public function save(User $user): User
    {
        try {
            $user->save();
            return $user;
        } catch (SystemDefaultException $exception) {
            $this->returnError($exception);
        }
    }

    public function update(User $user): User
    {
        try {
            $user->update();
            return $user;
        } catch (SystemDefaultException $exception) {
            $this->returnError($exception);
        }
    }

    public function delete(User $user): User
    {
        try {
            $user->delete();
            return $user;
        } catch (SystemDefaultException $exception) {
            $this->returnError($exception);
        }
    }
}
