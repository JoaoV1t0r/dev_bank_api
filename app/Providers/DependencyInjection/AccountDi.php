<?php

namespace App\Providers\DependencyInjection;

use App\Domains\Account\Abstract\IAccountStoreService;
use App\Domains\Account\Concrete\AccountStoreService;
use App\Infra\Database\Repositories\Abstract\IAccountRepository;
use App\Infra\Database\Repositories\Concrete\AccountRepository;

class AccountDi extends DependencyInjection
{

    protected function daoConfigurations(): array
    {
        return [];
    }

    protected function repositoriesConfigurations(): array
    {
        return [
            [IAccountRepository::class, AccountRepository::class]
        ];
    }

    protected function servicesConfiguration(): array
    {
        return [
            [IAccountStoreService::class, AccountStoreService::class]
        ];
    }

    protected function mappersConfiguration(): array
    {
        return [];
    }
}
