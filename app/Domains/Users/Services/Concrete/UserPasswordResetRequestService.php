<?php

namespace App\Domains\Users\Services\Concrete;

use App\Domains\Users\Services\Abstract\IUserPasswordResetRequestService;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\User\UserResetPasswordEmailNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Nette\Utils\Random;

class UserPasswordResetRequestService implements IUserPasswordResetRequestService
{

    private string $email;
    private null|Builder|Model|User $user;
    private string $token;

    public function requestResetPassword(string $email): bool
    {
        $this->setEmail($email);
        $this->setUser();
        $this->checkPasswordResetExists();
        $this->storeResetPasswordToken();
        $this->sendEmail();
        return true;
    }

    private function setEmail(string $email)
    {
        $this->email = $email;
    }

    private function setUser()
    {
        $this->user = User::query()->where('email', $this->email)->first();
    }

    private function checkPasswordResetExists()
    {
        if ($this->user->passwordReset()) {
            $this->user->passwordReset()->delete();
        }
    }

    private function storeResetPasswordToken()
    {
        $this->token = Random::generate(8, 'a-z0-9');
        $passwordReset = new PasswordReset();
        $passwordReset->user_id = $this->user->id;
        $passwordReset->email = $this->email;
        $passwordReset->token = $this->token;
        $passwordReset->save();

    }

    private function sendEmail()
    {
        $this->user->notify(new UserResetPasswordEmailNotification($this->token));
    }
}
