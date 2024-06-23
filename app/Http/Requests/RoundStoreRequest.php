<?php

namespace App\Http\Requests;

use App\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class RoundStoreRequest extends FormRequest
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
            'round' => 'required|number',
            'round_type_id' => 'required|exists:round_types,id',
            'championship_type_id' => 'required|exists:championship_types,id',
        ];
    }
}
