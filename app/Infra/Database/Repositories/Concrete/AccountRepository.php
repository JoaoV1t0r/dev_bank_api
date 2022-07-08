<?php

namespace App\Infra\Database\Repositories\Concrete;

use App\Exceptions\BusinessRuleViolationException;
use App\Infra\Database\Repositories\Abstract\IAccountRepository;
use App\Infra\Database\Repositories\RepositoryBase;
use App\Models\Account;
use Exception;

class AccountRepository extends RepositoryBase implements IAccountRepository
{

    /**
     * @throws BusinessRuleViolationException
     */
    public function storeAccount(Account $account): Account
    {
        try {
            $account->save();
            $account->refresh();
            return $account;
        } catch (Exception $e) {
            throw new BusinessRuleViolationException('Error updating registration request');
        }
    }

    /**
     * @throws BusinessRuleViolationException
     */
    public function update(Account $account): Account
    {
        try {
            $account->update();
            $account->refresh();
            return $account;
        } catch (Exception $e) {
            throw new BusinessRuleViolationException('Error updating registration request');
        }
    }

    /**
     * @throws BusinessRuleViolationException
     */
    public function delete(Account $account): void
    {
        try {
            $account->delete();
            $account->refresh();
        } catch (Exception $e) {
            throw new BusinessRuleViolationException('Error deleting registration request');
        }
    }
}
