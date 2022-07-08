<?php

namespace App\Providers\DependencyInjection;

use App\Domains\RegistrationRequest\Services\Abstract\IRegistrationRequestConfirmService;
use App\Domains\RegistrationRequest\Services\Abstract\IRegistrationRequestListingService;
use App\Domains\RegistrationRequest\Services\Concrete\RegistrationRequestConfirmService;
use App\Domains\RegistrationRequest\Services\Concrete\RegistrationRequestListingService;
use App\Infra\Database\Dao\RegistrationRequests\Abstract\IRegistrationRequestListingDb;
use App\Infra\Database\Dao\RegistrationRequests\Concrete\RegistrationRequestListingDb;
use App\Infra\Database\Repositories\Abstract\IRegistrationRequestRepository;
use App\Infra\Database\Repositories\Concrete\RegistrationRequestRepository;

class RegistrationRequestDi extends DependencyInjection
{

    protected function daoConfigurations(): array
    {
        return [
            [IRegistrationRequestListingDb::class, RegistrationRequestListingDb::class],
        ];
    }

    protected function repositoriesConfigurations(): array
    {
        return [
            [IRegistrationRequestRepository::class, RegistrationRequestRepository::class],
            [IRegistrationRequestConfirmService::class, RegistrationRequestConfirmService::class],
        ];
    }

    protected function servicesConfiguration(): array
    {
        return [
            [IRegistrationRequestListingService::class, RegistrationRequestListingService::class],
        ];
    }

    protected function mappersConfiguration(): array
    {
        return [];
    }
}
