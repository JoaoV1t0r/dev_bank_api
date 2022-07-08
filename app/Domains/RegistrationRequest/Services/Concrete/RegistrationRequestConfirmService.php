<?php

namespace App\Domains\RegistrationRequest\Services\Concrete;

use App\Domains\RegistrationRequest\Services\Abstract\IRegistrationRequestConfirmService;
use App\Exceptions\BusinessRuleViolationException;
use App\Infra\Database\Repositories\Abstract\IRegistrationRequestRepository;
use App\Models\RegistrationRequest;
use App\Notifications\User\UserConfirmEmailNotification;

class RegistrationRequestConfirmService implements IRegistrationRequestConfirmService
{
    private IRegistrationRequestRepository $registrationRequestRepository;

    public function __construct(
        IRegistrationRequestRepository $registrationRequestRepository
    )
    {
        $this->registrationRequestRepository = $registrationRequestRepository;
    }

    /**
     * @throws BusinessRuleViolationException
     */
    public function confirmRegistration(int $registrationRequestId): void
    {
        /** @var RegistrationRequest $registrationRequest */
        $registrationRequest = RegistrationRequest::query()->findOrFail($registrationRequestId);

        if ($registrationRequest->confirmed) {
            throw new BusinessRuleViolationException('Registration request already confirmed');
        }

        $this->registrationRequestRepository->confirmRegistration($registrationRequest);

        $registrationRequest->user->notify(new UserConfirmEmailNotification($registrationRequest->user->uuid));
    }
}
