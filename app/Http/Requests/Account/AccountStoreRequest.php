<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\Request;

/**
 * Class AccountStoreRequest
 * @package App\Http\Requests\Account
 * @property string $password
 */
class AccountStoreRequest extends Request
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
            'password' => 'required|integer|min:0000|max:9999',
        ];
    }
}
