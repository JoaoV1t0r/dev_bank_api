<?php

namespace App\Providers\DependencyInjection;

use App\Domains\Transfer\Services\Abstract\ITransferService;
use App\Domains\Transfer\Services\Concrete\TransferService;

class TransferDi extends DependencyInjection
{

    protected function daoConfigurations(): array
    {
        return [];
    }

    protected function repositoriesConfigurations(): array
    {
        return [

        ];
    }

    protected function servicesConfiguration(): array
    {
        return [
            [ITransferService::class, TransferService::class],
        ];
    }

    protected function mappersConfiguration(): array
    {
        return [];
    }
}
