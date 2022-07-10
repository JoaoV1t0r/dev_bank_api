<?php

namespace App\Providers\DependencyInjection;

use App\Domains\Deposit\Services\Abstract\IDepositPayService;
use App\Domains\Deposit\Services\Abstract\IDepositStoreService;
use App\Domains\Deposit\Services\Concrete\DepositPayService;
use App\Domains\Deposit\Services\Concrete\DepositStoreService;

class DepositDi extends DependencyInjection
{

    protected function daoConfigurations(): array
    {
        return [];
    }

    protected function repositoriesConfigurations(): array
    {
        return [];
    }

    protected function servicesConfiguration(): array
    {
        return [
            [IDepositStoreService::class, DepositStoreService::class],
            [IDepositPayService::class, DepositPayService::class],
        ];
    }

    protected function mappersConfiguration(): array
    {
        return [];
    }
}
