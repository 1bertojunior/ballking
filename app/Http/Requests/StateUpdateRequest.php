<?php

namespace App\Http\Requests;

use App\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class StateUpdateRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return auth()->user()->role_id == RoleEnum::ADMIN;
    }

   
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:45|unique:states,name,' . $this->state->id,
            'abb' => 'required|string|size:2|unique:states,abb,' . $this->state->id,
        ];
    }
}
