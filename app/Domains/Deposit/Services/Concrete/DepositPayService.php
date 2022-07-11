<?php

namespace App\Domains\Deposit\Services\Concrete;

use App\Models\Account;
use App\Models\Deposit;
use App\Models\DepositPayer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\Deposit\DepositPayRequest;
use App\Exceptions\BusinessRuleViolationException;
use App\Domains\Deposit\Services\Abstract\IDepositPayService;

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
        $this->checkAccountPassword();
        $this->checkDepositIsPaid();
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

    public function checkAccountPassword()
    {
        if (!Hash::check($this->request->accountPassword, $this->accountPayer->password)) {
            throw new BusinessRuleViolationException('Invalid account password');
        }
    }

    public function checkDepositIsPaid()
    {
        if (DB::table('deposit_payers')->where('deposit_id', $this->deposit->id)->get()->count()) {
            throw new BusinessRuleViolationException('Deposit already paid');
        }
    }

    private function payDeposit(): DepositPayer
    {
        $depositPayer = new DepositPayer();
        $depositPayer->deposit_id = $this->deposit->id;
        $depositPayer->account_id = $this->accountPayer->id;
        $this->accountPayer->balance -= $this->deposit->amount;
        $this->deposit->account->balance += $this->deposit->amount;
        $depositPayer->save();
        $this->accountPayer->update();
        $this->deposit->account->update();
        return $depositPayer;
    }
}
