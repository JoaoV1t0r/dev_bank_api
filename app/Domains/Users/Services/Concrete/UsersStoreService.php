<?php

namespace App\Domains\Users\Services\Concrete;

use App\Domains\Users\Services\Abstract\IUsersStoreService;
use App\Http\Requests\User\UserStoreRequest;
use App\Infra\Database\Repositories\Abstract\IRegistrationRequestRepository;
use App\Infra\Database\Repositories\Abstract\IUserRepository;
use App\Models\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersStoreService implements IUsersStoreService
{
    private IUserRepository $userRepository;
    private UserStoreRequest $request;
    private RegistrationRequest $registrationRequest;
    private IRegistrationRequestRepository $registrationRequestRepository;
    private User $newUser;

    /**
     * @param IRegistrationRequestRepository $registrationRequestRepository
     * @param RegistrationRequest $registrationRequest
     * @param IUserRepository $userRepository
     * @param User $newUser
     */
    public function __construct(
        IRegistrationRequestRepository $registrationRequestRepository,
        RegistrationRequest            $registrationRequest,
        IUserRepository                $userRepository,
        User                           $newUser,
    )
    {
        $this->registrationRequestRepository = $registrationRequestRepository;
        $this->registrationRequest = $registrationRequest;
        $this->userRepository = $userRepository;
        $this->newUser = $newUser;
    }


    public function storeUser(UserStoreRequest $request): User
    {
        $this->setRequest($request);
        $this->mapNewUser();
        $this->mapRegistrationRequest();
        $this->saveNewUser();
        return $this->newUser;
    }

    private function setRequest(UserStoreRequest $request)
    {
        $this->request = $request;
    }

    private function mapNewUser()
    {
        $this->newUser->name = $this->request->name;
        $this->newUser->email = $this->request->email;
        $this->newUser->password = Hash::make($this->request->password);
        $this->newUser->cpf = $this->request->cpf;
        $this->newUser->rg = $this->request->rg;
        $this->newUser->phone = $this->request->phone;
        $this->newUser->remember_token = Str::random(10);
    }

    private function mapRegistrationRequest(): void
    {
        $this->registrationRequest->user_id = $this->newUser->id;
        $this->registrationRequest->rg_photo = $this->request->rgPhoto->store('public/rg_photos');
        $this->registrationRequest->cpf_photo = $this->request->cpfPhoto->store('public/cpf_photos');
        $this->registrationRequest->confirm_address_photo = $this->request->confirmAddressPhoto->store('public/confirm_address_photos');
    }

    private function saveNewUser()
    {
        $this->newUser = $this->userRepository->save($this->newUser);
        $this->registrationRequest->user_id = $this->newUser->id;
        $this->registrationRequestRepository->save($this->registrationRequest);
    }
}
