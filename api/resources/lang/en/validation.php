<?php

return [
    'Titulo' => [
        'required' => 'The Title field is required.',
        'string' => 'The Title field must be a string.',
        'unique' => 'A book with this title already exists.',
    ],
    'Editora' => [
        'required' => 'The Publisher field is required.',
        'string' => 'The Publisher field must be a string.',
    ],
    'Edicao' => [
        'required' => 'The Edition field is required.',
        'integer' => 'The Edition field must be an integer.',
    ],
    'AnoPublicacao' => [
        'required' => 'The Publication Year field is required.',
        'integer' => 'The Publication Year field must be an integer.',
        'min' => 'The Publication Year must be at least 1900.',
        'max' => 'The Publication Year cannot be greater than the current year.',
    ],
    'Preco' => [
        'numeric' => 'The Price field must be a number.',
        'min' => 'The Price must be a positive value.',
    ],

    'autores' => 'The Authors field must be an array.',
    'autores.*.integer' => 'Each author must be a valid ID.',
    'autores.*.exists' => 'The selected author does not exist in the database.',

    'assuntos' => 'The Subjects field must be an array.',
    'assuntos.*.integer' => 'Each subject must be a valid ID.',
    'assuntos.*.exists' => 'The selected subject does not exist in the database.',

    'autor.nome' => [
        'required' => 'The Author Name field is required.',
        'string' => 'The Author Name must be a string.',
        'max' => 'The Author Name cannot exceed 40 characters.',
        'unique' => 'An author with this name already exists.',
    ],

    'assunto' => [
        'descricao' => [
            'required' => 'The Description field is required.',
            'string' => 'The Description field must be text.',
            'max' => 'The Description field cannot exceed 20 characters.',
            'unique' => 'A subject with this description already exists.',
        ],
    ],
];
