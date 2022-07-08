<?php

namespace App\Http\Controllers\Api;

use App\Domains\Account\Abstract\IAccountStoreService;
use App\Domains\Account\Abstract\IAccountUpdatePasswordService;
use App\Exceptions\SystemDefaultException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\AccountStoreRequest;
use App\Http\Requests\Account\AccountUpdatePasswordRequest;
use App\Support\Models\BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    private IAccountStoreService $accountStoreService;
    private IAccountUpdatePasswordService $accountUpdatePasswordService;

    public function __construct(
        IAccountStoreService          $accountStoreService,
        IAccountUpdatePasswordService $accountUpdatePasswordService
    )
    {
        $this->accountStoreService = $accountStoreService;
        $this->accountUpdatePasswordService = $accountUpdatePasswordService;
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

    public function putPasswordAccount(AccountUpdatePasswordRequest $request): Response
    {
        try {
            $isSuccess = $this->accountUpdatePasswordService->updatePassword($request);
            return BaseResponse::builder()
                ->setMessage($isSuccess ? 'Password updated successfully' : 'Password not updated')
                ->setData($isSuccess)
                ->response();
        } catch (SystemDefaultException $exception) {
            return $exception->response();
        }
    }
}
