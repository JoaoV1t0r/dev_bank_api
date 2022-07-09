<?php

namespace App\Domains\Transfer\Services\Abstract;

use App\Http\Requests\Transfer\TransferRequest;

interface ITransferService
{
    public function transfer(TransferRequest $request): bool;
}
