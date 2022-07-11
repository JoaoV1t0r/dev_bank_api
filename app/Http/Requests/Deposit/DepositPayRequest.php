<?php

namespace App\Http\Requests\Deposit;

use App\Http\Requests\Request;

/**
 * Class DepositPayRequest
 * @package App\Http\Requests\Deposit\
 * @property string $depositUuid
 * @property string $passwordAccount
 */
class DepositPayRequest extends Request
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'accountPassword' => 'required|string|min:4',
            'depositUuid' => 'required|string'
        ];
    }
}
