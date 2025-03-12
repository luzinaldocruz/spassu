<?php

namespace App\DTOs;

class LivroDTO
{
    public function __construct(
        public int $Codl,
        public string $Titulo,
        public string $Editora,
        public int $Edicao,
        public string $AnoPublicacao,
        public ?string $CreatedAt,
        public ?string $UpdatedAt,
        public ?float $Preco = 0,
        /** @var AutorDTO[] */
        public ?array $Autores = null,
        /** @var AssuntoDTO[] */
        public ?array $Assuntos = null,
    ) {}
}
