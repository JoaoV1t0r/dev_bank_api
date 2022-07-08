<?php

namespace App\Infra\Database\Repositories\Abstract;

use App\Models\Account;

interface IAccountRepository
{
    public function storeAccount(Account $account): Account;

    public function update(Account $account): Account;

    public function delete(Account $account): void;
}
