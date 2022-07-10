<?php

namespace App\Domains\Deposit\Services\Abstract;

use App\Http\Requests\Deposit\DepositPayRequest;
use App\Models\DepositPayer;

interface IDepositPayService
{
    public function pay(DepositPayRequest $request): DepositPayer;
}
