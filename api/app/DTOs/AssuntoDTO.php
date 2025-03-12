<?php

namespace App\DTOs;

class AssuntoDTO
{
    public function __construct(
        public int $CodAs,
        public ?string $Descricao,
    ) {}
}
