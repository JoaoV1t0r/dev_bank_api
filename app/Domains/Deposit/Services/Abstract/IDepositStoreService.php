<?php

namespace App\Domains\Deposit\Services\Abstract;

use App\Http\Requests\Deposit\DepositStoreRequest;
use App\Models\Deposit;

interface IDepositStoreService
{
    public function store(DepositStoreRequest $request): Deposit;
}
