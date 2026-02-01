<?php

namespace Modules\Availability\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Modules\Availability\Application\Dto\StoreAvailabilityDto;

class StoreAvailabilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],

            'url' => [
                'required',
                'string',
                'url',
                'max:150',
            ],

            'frequency' => [
                'required',
                'integer',
                'between:10,86400',
            ],

            'sendEmail' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Informe o nome do monitoramento.',
            'name.string' => 'O nome do monitoramento deve ser um texto.',
            'name.min' => 'O nome deve ter no mínimo :min caracteres.',
            'name.max' => 'O nome pode ter no máximo :max caracteres.',

            'url.required' => 'Informe a URL do site.',
            'url.string' => 'A URL deve ser um texto.',
            'url.url' => 'Informe uma URL válida (ex: https://exemplo.com).',
            'url.max' => 'A URL pode ter no máximo :max caracteres.',

            'frequency.required' => 'Informe o intervalo de monitoramento.',
            'frequency.integer' => 'A frequência deve ser um número inteiro.',
            'frequency.between' =>
                'A frequência deve estar entre :min e :max segundos (até 24 horas).',

            'sendEmail.required' =>
                'Informe se deseja receber notificações por e-mail.',
            'sendEmail.boolean' =>
                'O valor informado para notificações por e-mail é inválido.',
        ];
    }

    public function toDto()
    {
        $data = $this->validated();

        return new StoreAvailabilityDto(
            name: $data['name'],
            url: $data['url'],
            errorSendEmail: $data['sendEmail'],
            frequencySeconds: $data['frequency'],
            userId: Auth::id(),
        );
    }
}
