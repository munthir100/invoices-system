<?php

namespace App\Http\Requests\user;

use App\Models\Status;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'city_id' => 'required|exists:cities,id',
            'lang' => 'string',
            'lat' => 'string',
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'type' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'salesperson_id' => 'required|exists:salespeople,id',
            
        ];
    }
}
