<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AutorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        $rules = [];
        $id = $this->input('CodAu');

        if (in_array($request->method(), ['POST', 'PUT'])) {
            $rules = [
                'nome' => ['required', 'string', 'max:40', Rule::unique('autor', 'nome')->ignore($id, 'CodAu')],
            ];
        }

        if ($request->isMethod('PATCH')) {
            $rules = [
                'nome' => ['sometimes', 'string', 'max:40', Rule::unique('autor', 'nome')->ignore($id, 'CodAu')],
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nome.required' => __('validation.nome.required'),
            'nome.string' => __('validation.nome.string'),
            'nome.max' => __('validation.nome.max'),
            'nome.unique' => __('validation.nome.unique'),
        ];
    }
}
