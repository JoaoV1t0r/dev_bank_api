<?php

namespace App\Http\Controllers\Api;

use App\Domains\Account\Abstract\IAccountStoreService;
use App\Exceptions\SystemDefaultException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\AccountStoreRequest;
use App\Support\Models\BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    private IAccountStoreService $accountStoreService;

    public function __construct(
        IAccountStoreService $accountStoreService
    )
    {
        $this->accountStoreService = $accountStoreService;
    }

    public function postStoreAccount(AccountStoreRequest $request): Response
    {
        try {
            $account = $this->accountStoreService->storeAccount($request);
            return BaseResponse::builder()
                ->setStatusCode(201)
                ->setMessage('Account created successfully')
                ->setData($account)
                ->response();
        } catch (SystemDefaultException $exception) {
            return $exception->response();
        }
    }
}
