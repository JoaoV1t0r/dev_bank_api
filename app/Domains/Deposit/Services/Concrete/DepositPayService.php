<?php

namespace App\Domains\Deposit\Services\Concrete;

use App\Domains\Deposit\Services\Abstract\IDepositPayService;
use App\Http\Requests\Deposit\DepositPayRequest;
use App\Models\Account;
use App\Models\Deposit;
use App\Models\DepositPayer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DepositPayService implements IDepositPayService
{

    private DepositPayRequest $request;
    private null|Builder|Deposit|Model $deposit;
    private Builder|Model|Account $accountPayer;

    public function pay(DepositPayRequest $request): void
    {
        $this->setRequest($request);
        $this->setDeposit();
        $this->setAccountPayer();
        $this->payDeposit();
    }

    private function setRequest(DepositPayRequest $request)
    {
        $this->request = $request;
    }

    private function setDeposit()
    {
        $this->deposit = Deposit::query()->where('uuid', $this->request->depositUuid)->firstOrFail();
    }

    private function setAccountPayer()
    {
        $this->accountPayer = Account::query()->where('user_id', auth()->user()->id)->firstOrFail();
    }

    private function payDeposit()
    {
        $depositPayer = new DepositPayer();
    }
}
