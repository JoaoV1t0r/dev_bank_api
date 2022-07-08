<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use Illuminate\Http\UploadedFile;

/**
 * Class UserStoreRequest
 * @package App\Http\Requests\User
 * @property string name
 * @property string email
 * @property string password
 * @property string phone
 * @property string cpf
 * @property string rg
 * @property UploadedFile rgPhoto
 * @property UploadedFile cpfPhoto
 * @property UploadedFile confirmAddressPhoto
 */
class UserStoreRequest extends Request
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'name' => 'required|min:3',
            'phone' => 'required|min:10|celular_com_ddd',
            'cpf' => 'required|min:11|cpf',
            'rg' => 'required|min:10',
            'rgPhoto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'cpfPhoto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'confirmAddressPhoto' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        ];
    }
}
