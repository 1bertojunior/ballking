<?php

namespace App\Http\Requests;

use App\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class AddressStoreRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return in_array(auth()->user()->role_id, [RoleEnum::ADMIN, RoleEnum::USER]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'street' => 'required|string|max:45',
            'postal_code' => 'required|string|size:8',
            'city_id' => 'required|exists:cities,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
