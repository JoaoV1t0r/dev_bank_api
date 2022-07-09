<?php

namespace App\Providers\DependencyInjection;

use App\Domains\Users\Services\Abstract\IUserPasswordResetRequestService;
use App\Domains\Users\Services\Abstract\IUserPasswordResetService;
use App\Domains\Users\Services\Abstract\IUsersDeleteService;
use App\Domains\Users\Services\Abstract\IUsersListingService;
use App\Domains\Users\Services\Abstract\IUsersStoreService;
use App\Domains\Users\Services\Abstract\IUsersUpdateService;
use App\Domains\Users\Services\Abstract\IUsersVerifyEmailService;
use App\Domains\Users\Services\Concrete\UserPasswordResetRequestService;
use App\Domains\Users\Services\Concrete\UserPasswordResetService;
use App\Domains\Users\Services\Concrete\UsersDeleteService;
use App\Domains\Users\Services\Concrete\UsersListingService;
use App\Domains\Users\Services\Concrete\UsersStoreService;
use App\Domains\Users\Services\Concrete\UsersUpdateService;
use App\Domains\Users\Services\Concrete\UsersVerifyEmailService;
use App\Infra\Database\Dao\Users\Abstract\IUsersListingDb;
use App\Infra\Database\Dao\Users\Concrete\UserListingDb;
use App\Infra\Database\Repositories\Abstract\IUserRepository;
use App\Infra\Database\Repositories\Concrete\UserRepository;

class UsersDi extends DependencyInjection
{
    protected function servicesConfiguration(): array
    {
        return [
            [IUsersStoreService::class, UsersStoreService::class],
            [IUsersListingService::class, UsersListingService::class],
            [IUsersUpdateService::class, UsersUpdateService::class],
            [IUsersDeleteService::class, UsersDeleteService::class],
            [IUsersVerifyEmailService::class, UsersVerifyEmailService::class],
            [IUserPasswordResetService::class, UserPasswordResetService::class],
            [IUserPasswordResetRequestService::class, UserPasswordResetRequestService::class],
        ];
    }

    protected function daoConfigurations(): array
    {
        return [
            [IUsersListingDb::class, UserListingDb::class],
        ];
    }

    protected function mappersConfiguration(): array
    {
        return [];
    }

    protected function repositoriesConfigurations(): array
    {
        return [
            [IUserRepository::class, UserRepository::class],
        ];
    }
}

{
}
