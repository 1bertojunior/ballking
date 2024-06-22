<?php

namespace App\Http\Requests;

use App\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class CityUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role_id == RoleEnum::ADMIN;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:45|unique:cities,name,' . $this->city->id,
            'abb' => 'required|string|size:3|unique:cities,abb,' . $this->city->id,
            'state_id' => 'required|exists:states,id',
        ];
    }
}
