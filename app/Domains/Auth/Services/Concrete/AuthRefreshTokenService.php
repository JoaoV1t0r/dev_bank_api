<?php

namespace App\Domains\Auth\Services\Concrete;

use App\Domains\Auth\Services\Abstract\IAuthRefreshTokenService;

class AuthRefreshTokenService implements IAuthRefreshTokenService
{
    private string $newToken;

    public function refreshToken(): array
    {
        $this->generateRefreshToken();
        return $this->getDataLogin();
    }

    private function generateRefreshToken()
    {
        $this->newToken = auth()->refresh();
    }

    private function getDataLogin(): array
    {
        return [
            'access_token' => $this->newToken,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL(),
        ];
    }
}
