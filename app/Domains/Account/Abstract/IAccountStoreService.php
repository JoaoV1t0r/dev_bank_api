<?php

namespace App\Domains\Account\Abstract;

use App\Http\Requests\Account\AccountStoreRequest;
use App\Models\Account;

interface IAccountStoreService
{
    public function storeAccount(AccountStoreRequest $request): Account;
}
