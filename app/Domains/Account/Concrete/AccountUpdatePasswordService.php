<?php

namespace App\Domains\Account\Concrete;

use App\Domains\Account\Abstract\IAccountUpdatePasswordService;
use App\Exceptions\HttpBadRequest;
use App\Http\Requests\Account\AccountUpdatePasswordRequest;
use App\Infra\Database\Repositories\Abstract\IAccountRepository;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class AccountUpdatePasswordService implements IAccountUpdatePasswordService
{
    private IAccountRepository $accountRepository;
    private AccountUpdatePasswordRequest $request;
    private Account $account;

    public function __construct(
        IAccountRepository $accountRepository
    )
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * @throws HttpBadRequest
     */
    public function updatePassword(AccountUpdatePasswordRequest $request): bool
    {
        $this->setRequest($request);
        $this->setAccount();
        $this->checkPassword();
        $this->setNewPassword();
        $this->accountRepository->update($this->account);
        return true;
    }

    private function setRequest(AccountUpdatePasswordRequest $request)
    {
        $this->request = $request;
    }

    private function setAccount()
    {
        $this->account = auth()->user()->account;
    }

    /**
     * @throws HttpBadRequest
     */
    private function checkPassword()
    {
        if (!Hash::check($this->request->oldPassword, $this->account->password)) {
            throw new HttpBadRequest('Invalid old password');
        }
    }

    private function setNewPassword()
    {
        $this->account->password = $this->request->password;
    }
}
