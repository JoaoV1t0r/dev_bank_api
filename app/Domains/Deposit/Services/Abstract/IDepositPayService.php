<?php

namespace App\Domains\Deposit\Services\Abstract;

use App\Http\Requests\Deposit\DepositPayRequest;

interface IDepositPayService
{
    public function pay(DepositPayRequest $request): void;
}
