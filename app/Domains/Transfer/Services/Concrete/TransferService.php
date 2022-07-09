<?php

namespace App\Domains\Transfer\Services\Concrete;

use App\Domains\Transfer\Services\Abstract\ITransferService;
use App\Exceptions\BusinessRuleViolationException;
use App\Http\Requests\Transfer\TransferRequest;
use App\Models\User;
use App\Notifications\Transfer\TransferReceived;
use App\Notifications\Transfer\TransferSent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class TransferService implements ITransferService
{
    private TransferRequest $request;
    private User|Model|null $userDestination;
    private User|Model|null $userSent;

    /**
     * @throws BusinessRuleViolationException
     */
    public function transfer(TransferRequest $request): bool
    {
        $this->setRequest($request);
        $this->setUserDestination();
        $this->setUserSent();
        $this->validateAmount();
        $this->validateAccountPassword();
        $this->transferAmount();
        return true;
    }

    private function setRequest(TransferRequest $request): void
    {
        $this->request = $request;
    }

    private function setUserDestination(): void
    {
        $this->userDestination = User::query()->with('account')->where('cpf', $this->request->userCpf)->first();
    }

    private function setUserSent(): void
    {
        $this->userSent = User::query()->find(auth()->user()->id);
    }

    /**
     * @throws BusinessRuleViolationException
     */
    private function validateAmount(): void
    {
        if ($this->userSent->account->balance < $this->request->amount) {
            throw new BusinessRuleViolationException('Insufficient funds');
        }
    }

    /**
     * @throws BusinessRuleViolationException
     */
    private function validateAccountPassword(): void
    {
        if (!Hash::check($this->request->accountPassword, $this->userSent->account->password)) {
            throw new BusinessRuleViolationException('Invalid account password');
        }
    }

    private function transferAmount(): void
    {
        $this->userSent->account->balance -= $this->request->amount;
        $this->userDestination->account->balance += $this->request->amount;
        $this->userSent->account->update();
        $this->userDestination->account->update();
        $this->userDestination->notify(new TransferReceived($this->request->amount, $this->userSent->name, $this->userSent->account->number));
        $this->userSent->notify(new TransferSent($this->request->amount, $this->userDestination->name, $this->userDestination->account->number));
    }
}
