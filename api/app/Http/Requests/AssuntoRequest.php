<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssuntoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->input('CodAs');

        if ($this->isMethod('POST') || $this->isMethod('PUT')) {
            return [
                'descricao' => ['required', 'string', 'max:20', Rule::unique('assunto', 'descricao')->ignore($id, 'CodAs')],
            ];
        }

        if ($this->isMethod('PATCH')) {
            return [
                'descricao' => ['sometimes', 'string', 'max:20', Rule::unique('assunto', 'descricao')->ignore($id, 'CodAs')],
            ];
        }

        return [];
    }

    public function messages(): array
    {
        return [
            'descricao.required' => __('validation.assunto.descricao.required'),
            'descricao.string' => __('validation.assunto.descricao.string'),
            'descricao.max' => __('validation.assunto.descricao.max'),
            'descricao.unique' => __('validation.assunto.descricao.unique'),
        ];
    }
}
