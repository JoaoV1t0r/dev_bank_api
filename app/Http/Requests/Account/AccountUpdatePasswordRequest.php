<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\Request;

/**
 * Class AccountUpdatePasswordRequest
 * @package App\Http\Requests\Account
 * @property string $password
 * @property string $oldPassword
 */
class AccountUpdatePasswordRequest extends Request
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
            'password' => 'required|confirmed|digits:4',
            'oldPassword' => 'required',
        ];
    }
}
