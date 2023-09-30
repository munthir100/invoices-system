<?php

namespace App\Http\Requests\user;

use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCustomerRequest extends FormRequest
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
            'address' => 'required|string|max:255',
            'lang' => 'required',
            'lat' => 'required',
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'type' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'user_id' => [
                'required',
                Rule::exists('users', 'id')
                    ->where(function ($query) {
                        $query->where('role', 'saleperson')
                            ->where('status_id', Status::ACTIVE);
                    }),
            ],
        ];
    }


    function messages()
    {
        return [
            'lang.required' => 'You must enter the longitude value.',
            'lat.required' => 'You must enter the latitude value.',
            'user_id' => 'invaild user selected.',
        ];
    }
}
