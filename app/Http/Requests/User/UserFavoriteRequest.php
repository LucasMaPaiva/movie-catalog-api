<?php

namespace App\Http\Requests\User;

use App\Base\Traits\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserFavoriteRequest extends FormRequest {

    use Response;

    public function rules(): array {
        return [
            'movie_id' => 'required|int',
            'movie_details' => 'json'
        ];
    }

    protected function failedValidation(Validator $validator) {
        return self::failedValidationResponse($validator);
    }


    public function authorize(): bool {
        return true;
    }

    public function prepareForValidation(): void {
        $this->merge([
            'movie_details' => json_encode($this->input('movie_details'))
        ]);
    }
}
