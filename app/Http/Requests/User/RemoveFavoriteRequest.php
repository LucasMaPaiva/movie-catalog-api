<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RemoveFavoriteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'movie_id' => 'required|integer',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
