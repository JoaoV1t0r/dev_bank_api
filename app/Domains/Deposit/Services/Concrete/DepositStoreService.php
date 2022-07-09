<?php

namespace App\Domains\Deposit\Services\Concrete;

use App\Domains\Deposit\Services\Abstract\IDepositStoreService;
use App\Http\Requests\Deposit\DepositStoreRequest;
use App\Models\Account;
use App\Models\Deposit;

class DepositStoreService implements IDepositStoreService
{
    private DepositStoreRequest $request;

    public function store(DepositStoreRequest $request): Deposit
    {
        $this->setRequest($request);
        return $this->createDeposit();
    }

    private function setRequest(DepositStoreRequest $request)
    {
        $this->request = $request;
    }

    private function createDeposit(): Deposit
    {
        $deposit = new Deposit();
        $deposit->account_id = Account::query()->where('user_id', auth()->user()->id)->first()->id;
        $deposit->amount = $this->request->amount;
        $deposit->valid_until = now()->addDays(3);
        $deposit->save();
        return $deposit;
    }
}
