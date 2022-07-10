<?php

namespace App\Http\Controllers\Api;

use App\Domains\Deposit\Services\Abstract\IDepositPayService;
use App\Domains\Deposit\Services\Abstract\IDepositStoreService;
use App\Exceptions\SystemDefaultException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Deposit\DepositPayRequest;
use App\Http\Requests\Deposit\DepositStoreRequest;
use App\Support\Models\BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class DepositController extends Controller
{
    private IDepositStoreService $depositStoreService;
    private IDepositPayService $depositPayService;

    public function __construct(
        IDepositStoreService $depositStoreService,
        IDepositPayService   $depositPayService
    )
    {
        $this->depositStoreService = $depositStoreService;
        $this->depositPayService = $depositPayService;
    }

    public function postStoreDeposit(DepositStoreRequest $request): Response
    {
        try {
            $deposit = $this->depositStoreService->store($request);
            return BaseResponse::builder()
                ->setMessage('Deposit created')
                ->setData($deposit)
                ->response();
        } catch (SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function postPayDeposit(DepositPayRequest $request): Response
    {
        try {
            $depositPayer = $this->depositPayService->pay($request);
            return BaseResponse::builder()
                ->setMessage('Deposit paid')
                ->setData($depositPayer)
                ->response();
        } catch (SystemDefaultException $e) {
            return $e->response();
        }
    }

}
