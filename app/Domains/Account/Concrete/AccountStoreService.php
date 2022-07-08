<?php

namespace App\Domains\Account\Concrete;

use App\Domains\Account\Abstract\IAccountStoreService;
use App\Exceptions\BusinessRuleViolationException;
use App\Http\Requests\Account\AccountStoreRequest;
use App\Infra\Database\Repositories\Abstract\IAccountRepository;
use App\Models\Account;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Nette\Utils\Random;

class AccountStoreService implements IAccountStoreService
{
    private IAccountRepository $accountRepository;
    private AccountStoreRequest $request;
    private User|null|Authenticatable $user;
    private Account $account;

    public function __construct(IAccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->user = auth()->user();
    }

    /**
     * @throws BusinessRuleViolationException
     */
    public function storeAccount(AccountStoreRequest $request): Account
    {
        $this->setRequest($request);
        $this->checkUserHasAccount();
        $this->mapAccount();
        return $this->accountRepository->storeAccount($this->account);
    }

    private function setRequest(AccountStoreRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @throws BusinessRuleViolationException
     */
    private function checkUserHasAccount()
    {
        if (is_null($this->user->account())) {
            throw new BusinessRuleViolationException('User already has account');
        }
    }

    private function mapAccount()
    {
        $this->account = new Account();
        $this->account->user_id = $this->user->id;
        $this->account->number = Random::generate(8, '0123456789');
        $this->account->balance = 0;
        $this->account->password = $this->request->password;
    }
}
