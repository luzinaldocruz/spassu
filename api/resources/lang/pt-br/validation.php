<?php

return [
    'Titulo' => [
        'required' => 'O campo Título é obrigatório.',
        'string' => 'O campo Título deve ser uma string.',
        'unique' => 'Já existe um livro com este título.',
    ],
    'Editora' => [
        'required' => 'O campo Editora é obrigatório.',
        'string' => 'O campo Editora deve ser uma string.',
    ],
    'Edicao' => [
        'required' => 'O campo Edição é obrigatório.',
        'integer' => 'O campo Edição deve ser um número inteiro.',
    ],
    'AnoPublicacao' => [
        'required' => 'O campo Ano de Publicação é obrigatório.',
        'integer' => 'O campo Ano de Publicação deve ser um número inteiro.',
        'min' => 'O campo Ano de Publicação deve ser no mínimo 1900.',
        'max' => 'O campo Ano de Publicação não pode ser maior que o ano atual.',
    ],
    'Preco' => [
        'numeric' => 'O campo Preço deve ser um número.',
        'min' => 'O campo Preço deve ser um valor positivo.',
    ],

    'autores' => 'O campo Autores deve ser um array.',
    'autores.*.integer' => 'Cada autor deve ser um ID válido.',
    'autores.*.exists' => 'O autor selecionado não existe na base de dados.',

    'assuntos' => 'O campo Assuntos deve ser um array.',
    'assuntos.*.integer' => 'Cada assunto deve ser um ID válido.',
    'assuntos.*.exists' => 'O assunto selecionado não existe na base de dados.',

    'autor.nome' => [
        'required' => 'O campo Nome do Autor é obrigatório.',
        'string' => 'O Nome do Autor deve ser uma string.',
        'max' => 'O Nome do Autor não pode ter mais de 40 caracteres.',
        'unique' => 'Já existe um autor cadastrado com este nome.',
    ],

    'assunto' => [
        'descricao' => [
            'required' => 'O campo Descrição é obrigatório.',
            'string' => 'O campo Descrição deve ser um texto.',
            'max' => 'O campo Descrição não pode ultrapassar 20 caracteres.',
            'unique' => 'Já existe um assunto com esta descrição.',
        ],
    ],
];
