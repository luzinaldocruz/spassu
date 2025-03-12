<?php

namespace App\DTOs;

class AutorDTO
{
    public function __construct(
        public int $CodAu,
        public ?string $nome,
    ) {}
}
