<?php

namespace App\Domains\Users\Services\Concrete;

use App\Domains\Users\Services\Abstract\IUserPasswordResetService;
use App\Exceptions\BusinessRuleViolationException;
use App\Http\Requests\User\UserResetPasswordRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserPasswordResetService implements IUserPasswordResetService
{
    private UserResetPasswordRequest $request;
    private null|Builder|User|Model $user;

    /**
     * @throws BusinessRuleViolationException
     */
    public function resetPassword(UserResetPasswordRequest $request): bool
    {
        $this->setRequest($request);
        $this->validateToken();
        $this->updatePassword();
        $this->deleteToken();
        return true;
    }

    private function setRequest(UserResetPasswordRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @throws BusinessRuleViolationException
     */
    private function validateToken()
    {
        $token = $this->request->token;
        $this->user = User::query()->where('email', $this->request->email)->first();
        if (!$this->user || !$this->user->passwordReset || $this->user->passwordReset->token != $token) {
            throw new BusinessRuleViolationException('Invalid token');
        }
    }

    private function updatePassword()
    {
        $this->user->password = $this->request->password;
        $this->user->save();
    }

    private function deleteToken()
    {
        $this->user->passwordReset->delete();
    }
}
