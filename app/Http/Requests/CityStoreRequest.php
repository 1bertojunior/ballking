<?php

namespace App\Http\Requests;

use App\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class CityStoreRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return auth()->user()->role_id == RoleEnum::ADMIN;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:45|unique:cities',
            'abb' => 'required|string|size:3|unique:cities,abb',
            'state_id' => 'required|exists:states,id',
        ];
    }
}
