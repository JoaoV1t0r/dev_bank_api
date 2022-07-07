<?php

namespace App\Infra\Database\Repositories\Abstract;

use App\Models\RegistrationRequest;

interface IRegistrationRequestRepository
{
    public function save(RegistrationRequest $registrationRequest): void;

    public function delete(RegistrationRequest $registrationRequest): void;

    public function update(RegistrationRequest $registrationRequest): void;

    public function confirmRegistration(RegistrationRequest $registrationRequest): void;

}
