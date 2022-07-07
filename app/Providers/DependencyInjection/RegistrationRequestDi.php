<?php

namespace App\Providers\DependencyInjection;

use App\Infra\Database\Repositories\Abstract\IRegistrationRequestRepository;
use App\Infra\Database\Repositories\Concrete\RegistrationRequestRepository;

class RegistrationRequestDi extends DependencyInjection
{

    protected function daoConfigurations(): array
    {
        return [];
    }

    protected function repositoriesConfigurations(): array
    {
        return [
            [IRegistrationRequestRepository::class, RegistrationRequestRepository::class],
        ];
    }

    protected function servicesConfiguration(): array
    {
        return [];
    }

    protected function mappersConfiguration(): array
    {
        return [];
    }
}
