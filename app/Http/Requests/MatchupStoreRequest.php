<?php

namespace App\Http\Requests;

use App\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class MatchupStoreRequest extends FormRequest
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
            'start' => 'required|date',
            'team_home_score' => 'nullable|integer',
            'team_away_score' => 'nullable|integer',
            'round_id' => 'required|exists:rounds,id',
            'team_home_id' => 'required|exists:team_editions,id',
            'team_away_id' => 'required|exists:team_editions,id',
        ];
    }
}
