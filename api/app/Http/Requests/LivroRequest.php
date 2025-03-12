<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LivroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        $rules = [];
        $id = $this->input('Codl');
        if (in_array($request->method(), ['POST', 'PUT'])) {
            $rules =
                [
                    'Titulo' => ['required', 'string', Rule::unique('livro', 'Titulo')->ignore($id, 'Codl')],
                    'Editora' => ['required', 'string'],
                    'Edicao' => ['required', 'integer'],
                    'AnoPublicacao' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
                    'Preco' => ['nullable', 'numeric', 'min:0'],
                    'autores' => ['nullable', 'array'],
                    'autores.*' => ['integer', 'exists:autor,CodAu'],
                    'assuntos' => ['nullable', 'array'],
                    'assuntos.*' => ['integer', 'exists:assunto,CodAs'],
                ];
        }

        if ($request->isMethod('PATCH')) {
            $rules = [
                'Titulo' => ['sometimes', 'string', Rule::unique('livro', 'Titulo')->ignore($id, 'Codl')],
                'Editora' => ['sometimes', 'string'],
                'Edicao' => ['sometimes', 'integer'],
                'AnoPublicacao' => ['sometimes', 'integer', 'min:1900', 'max:' . date('Y')],
                'Preco' => ['sometimes', 'numeric', 'min:0'],
                'autores' => ['sometimes', 'array'],
                'autores.*' => ['integer', 'exists:autor,CodAu'],
                'assuntos' => ['sometimes', 'array'],
                'assuntos.*' => ['integer', 'exists:assunto,CodAs'],
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'Titulo.required' => __('validation.Titulo.required'),
            'Titulo.string' => __('validation.Titulo.string'),
            'Titulo.unique' => __('validation.Titulo.unique'),

            'Editora.required' => __('validation.Editora.required'),
            'Editora.string' => __('validation.Editora.string'),

            'Edicao.required' => __('validation.Edicao.required'),
            'Edicao.integer' => __('validation.Edicao.integer'),

            'AnoPublicacao.required' => __('validation.AnoPublicacao.required'),
            'AnoPublicacao.integer' => __('validation.AnoPublicacao.integer'),
            'AnoPublicacao.min' => __('validation.AnoPublicacao.min'),
            'AnoPublicacao.max' => __('validation.AnoPublicacao.max'),

            'Preco.numeric' => __('validation.Preco.numeric'),
            'Preco.min' => __('validation.Preco.min'),

            'autores.array' => __('validation.autores.array'),
            'autores.*.integer' => __('validation.autores.*.integer'),
            'autores.*.exists' => __('validation.autores.*.exists'),

            'assuntos.array' => __('validation.assuntos.array'),
            'assuntos.*.integer' => __('validation.assuntos.*.integer'),
            'assuntos.*.exists' => __('validation.assuntos.*.exists'),
        ];
    }
}
