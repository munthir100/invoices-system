<?php

namespace App\Http\Requests\administrator;

use App\Models\Status;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSalepersonRequest extends FormRequest
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
            'name' => 'string|max:255',
            'email' => 'email|max:255',
            'password' => 'required|string|max:255',
            'permissions' => [
                'array',
                Rule::in(Config::get('permissions.saleperson-permissions'))
            ],
            'status_id' => [
                'required',
                Rule::in(Status::ACTIVE, Status::BLOCKED)
            ],
        ];
    }
}
