<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Modules\Users\Application\Dto\CreateUserDto;

class CreateUserRequest extends FormRequest {
    public function rules() {
        return [
            "name"=> "required|string|max:255",
            "email" => "required|email|max:255",
            "password"=> [
                "required", 
                Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigado',
            'email.required' => 'O campo email é obrigado',
            'email.email' => 'O campo email deve receber um email valido.',
            'password.required' => 'O campo password é obrigado',
            'password.min' => 'A senha precisa ter pelo menos 8 caracteres.',
            'password.mixed' => 'A senha precisa ter letras maiúsculas e minúsculas.',
            'password.numbers' => 'A senha precisa ter pelo menos um número.',
            'password.symbols' => 'A senha precisa ter pelo menos um símbolo.',
        ];
    }

    public function toDto() {
        $data = $this->validated();

        return new CreateUserDto(
            name: $data['name'],
            email: $data['email'],
            password: $data['password']
        );
    }
}