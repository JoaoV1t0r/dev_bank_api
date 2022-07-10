<?php

namespace App\Domains\Deposit\Services\Concrete;

use App\Domains\Deposit\Services\Abstract\IDepositPayService;
use App\Exceptions\BusinessRuleViolationException;
use App\Http\Requests\Deposit\DepositPayRequest;
use App\Models\Account;
use App\Models\Deposit;
use App\Models\DepositPayer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DepositPayService implements IDepositPayService
{

    private DepositPayRequest $request;
    private null|Builder|Deposit|Model $deposit;
    private Builder|Model|Account $accountPayer;

    /**
     * @throws BusinessRuleViolationException
     */
    public function pay(DepositPayRequest $request): DepositPayer
    {
        $this->setRequest($request);
        $this->setDeposit();
        $this->setAccountPayer();
        $this->checkBalancePayer();
        return $this->payDeposit();
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

    /**
     * @throws BusinessRuleViolationException
     */
    private function checkBalancePayer()
    {
        if ($this->accountPayer->balance < $this->deposit->amount) {
            throw new BusinessRuleViolationException('Not enough money');
        }
    }

    private function payDeposit(): DepositPayer
    {
        DB::beginTransaction();
        $depositPayer = new DepositPayer();
        $depositPayer->deposit_id = $this->deposit->id;
        $depositPayer->account_id = $this->accountPayer->id;
        $this->accountPayer->balance -= $this->deposit->amount;
        $this->deposit->account->balance += $this->deposit->amount;
        if (
            $depositPayer->save()
            or $this->accountPayer->save()
            or $this->deposit->account->save()
        )
            DB::commit();
        return $depositPayer;
    }
}
