<?php

namespace App\Domains\RegistrationRequest\Services\Abstract;

interface IRegistrationRequestConfirmService
{
    public function confirmRegistration(int $registrationRequestId): void;
}
