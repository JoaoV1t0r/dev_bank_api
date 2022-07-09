<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

/**
 * Class UserResetPasswordRequest
 * @package App\Http\Requests\User
 * @property string $email
 * @property string $token
 * @property string $password
 */
class UserResetPasswordRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
