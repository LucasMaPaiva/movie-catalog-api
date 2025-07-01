<?php

namespace App\Http\Requests\Auth;

use App\Base\Traits\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {

    use Response;

    public function rules(): array {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
            'password' => 'required|string|max:255',
        ];
    }

    protected function failedValidation(Validator $validator) {
        return self::failedValidationResponse($validator);
    }


    public function authorize(): bool {
        return true;
    }
}
