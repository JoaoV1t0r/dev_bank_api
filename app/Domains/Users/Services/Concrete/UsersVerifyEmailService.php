<?php

namespace App\Domains\Users\Services\Concrete;

use App\Models\User;
use App\Domains\Users\Services\Abstract\IUsersVerifyEmailService;
use App\Infra\Database\Repositories\Abstract\IUserRepository;
use Carbon\Carbon;

class UsersVerifyEmailService implements IUsersVerifyEmailService
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function verifyEmail(string $userUuid): bool
    {
        $this->setUserVerified($userUuid);
        return true;
    }

    private function setUserVerified(string $userUuid): void
    {
        /** @var User $user */
        $user = User::query()->where('uuid', $userUuid)->firstOrFail();
        $user->email_verified_at = Carbon::now();
        $this->userRepository->update($user);
    }
}
