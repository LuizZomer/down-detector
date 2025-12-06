<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Application\Dto\LoginDto;

class LoginRequest extends FormRequest {
    public function rules() {
        return [
            'email' => 'required|email',
            'password'=> 'required',
        ];
    }

    public function messages() {
        return [
            'email.email' => 'O campo email deve receber um email valido.',
            'password.required' => 'O campo password é obrigado',
        ];
    }

    public function toDto() {
        $data = $this->validated();

        return new LoginDto(
            email: $data['email'],
            password: $data['password'],
        );
    }
}