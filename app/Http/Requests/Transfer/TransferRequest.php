<?php

namespace App\Http\Requests\Transfer;

use App\Http\Requests\Request;

/**
 * Class TransferRequest.
 * Paclass App\Http\Requests\Transfer\TransferRequest
 * @property string userCpf
 * @property float amount
 * @property string accountPassword
 */
class TransferRequest extends Request
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
            'amount' => 'required|numeric|min:1',
            'accountPassword' => 'required|integer|digits:4',
            'userCpf' => 'required|exists:users,cpf|cpf',
        ];
    }
}
