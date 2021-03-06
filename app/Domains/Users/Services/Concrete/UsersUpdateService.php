<?php

namespace App\Domains\Users\Services\Concrete;

use App\Domains\Users\Services\Abstract\IUsersUpdateService;
use App\Http\Requests\User\UserUpdateRequest;
use App\Infra\Database\Repositories\Abstract\IUserRepository;
use App\Models\User;

class UsersUpdateService implements IUsersUpdateService
{
    private UserUpdateRequest $request;
    private User $userUpdate;
    private IUserRepository $userRepository;

    /**
     * @param IUserRepository $userRepository
     */
    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function userUpdate(UserUpdateRequest $request): User
    {
        $this->setRequest($request);
        $this->setUserUpdate();
        $this->mapUserUpdate();
        $this->updateUser();
        return $this->userUpdate;
    }

    private function setRequest(UserUpdateRequest $request): void
    {
        $this->request = $request;
    }

    private function setUserUpdate(): void
    {
        $this->userUpdate = User::find(auth()->user()->id);
    }

    private function mapUserUpdate(): void
    {
        $this->userUpdate->phone = $this->request->phone ?? $this->userUpdate->phone;
        $this->userUpdate->password = $this->request->password ?? $this->userUpdate->password;
    }


    private function updateUser(): void
    {
        $this->userRepository->update($this->userUpdate);
    }
}
