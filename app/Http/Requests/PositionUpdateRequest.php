<?php

namespace App\Http\Requests;

use App\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class PositionUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role_id == RoleEnum::ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:45|unique:positions,name,' . $this->position->id,
            'abb' => 'required|string|size:3|unique:positions,abb, ' . $this->position->id,
        ];
    }
}
