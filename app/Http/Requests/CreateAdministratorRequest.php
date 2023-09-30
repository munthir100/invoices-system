<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Http\FormRequest;

class CreateAdministratorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'permissions' => [
                'required',
                'array',
                Rule::in(Config::get('permissions.administrator-permissions'))
            ],
        ];
    }
}
