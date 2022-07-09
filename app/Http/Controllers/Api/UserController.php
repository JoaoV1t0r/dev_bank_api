<?php

namespace App\Http\Controllers\Api;

use App\Domains\Users\Services\Abstract\IUserPasswordResetRequestService;
use App\Domains\Users\Services\Abstract\IUserPasswordResetService;
use App\Domains\Users\Services\Abstract\IUsersStoreService;
use App\Domains\Users\Services\Abstract\IUsersUpdateService;
use App\Domains\Users\Services\Abstract\IUsersVerifyEmailService;
use App\Exceptions\SystemDefaultException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserResetPasswordRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Support\Models\BaseResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private IUsersStoreService $usersStoreService;
    private IUsersUpdateService $usersUpdateService;
    private IUsersVerifyEmailService $usersVerifyEmailService;
    private IUserPasswordResetService $usersResetPasswordService;
    private IUserPasswordResetRequestService $usersResetPasswordRequestService;


    /**
     * @param IUsersStoreService $usersStoreService
     * @param IUsersUpdateService $usersUpdateService
     * @param IUsersVerifyEmailService $usersVerifyEmailService
     * @param IUserPasswordResetService $usersResetPasswordService
     * @param IUserPasswordResetRequestService $usersResetPasswordRequestService
     */
    public function __construct(
        IUsersStoreService               $usersStoreService,
        IUsersUpdateService              $usersUpdateService,
        IUsersVerifyEmailService         $usersVerifyEmailService,
        IUserPasswordResetService        $usersResetPasswordService,
        IUserPasswordResetRequestService $usersResetPasswordRequestService
    )
    {
        $this->usersStoreService = $usersStoreService;
        $this->usersUpdateService = $usersUpdateService;
        $this->usersVerifyEmailService = $usersVerifyEmailService;
        $this->usersResetPasswordService = $usersResetPasswordService;
        $this->usersResetPasswordRequestService = $usersResetPasswordRequestService;
    }


    public function store(UserStoreRequest $request): Response
    {
        try {
            $newUser = $this->usersStoreService->storeUser($request);
            return BaseResponse::builder()
                ->setMessage('Successfully create user!')
                ->setData($newUser)
                ->response();
        } catch (SystemDefaultException $exception) {
            return $exception->response();
        }
    }

    public function update(UserUpdateRequest $request): Response
    {
        try {
            $updateUser = $this->usersUpdateService->userUpdate($request);
            return BaseResponse::builder()
                ->setMessage('Successfully update user!')
                ->setData($updateUser)
                ->response();
        } catch (SystemDefaultException $exception) {
            return $exception->response();
        }
    }

    public function verifyEmail(string $userUuid): Response
    {
        try {
            $this->usersVerifyEmailService->verifyEmail($userUuid);
            return BaseResponse::builder()
                ->setMessage('Successfully verify email!')
                ->setData(true)
                ->setStatusCode(202)
                ->response();
        } catch (SystemDefaultException $exception) {
            return $exception->response();
        }
    }

    public function resetPasswordRequest(Request $request): Response
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return BaseResponse::builder()
                    ->setMessage('Validation error!')
                    ->setData($validator->errors())
                    ->setStatusCode(202)
                    ->response();
            }
            $this->usersResetPasswordRequestService->requestResetPassword($request->email);
            return BaseResponse::builder()
                ->setMessage('Successfully request reset password!')
                ->setData(true)
                ->setStatusCode(202)
                ->response();
        } catch (SystemDefaultException $exception) {
            return $exception->response();
        }
    }

    public function resetPassword(UserResetPasswordRequest $request): Response
    {
        try {
            $this->usersResetPasswordService->resetPassword($request);
            return BaseResponse::builder()
                ->setMessage('Successfully reset password!')
                ->setData(true)
                ->setStatusCode(202)
                ->response();
        } catch (SystemDefaultException $exception) {
            return $exception->response();
        }
    }


}
