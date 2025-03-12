<?php

namespace App\DTOs;

use DateTime;

class LivroPrecoDTO
{
    public function __construct(
        public ?float $Preco,
        public ?DateTime $Data
    ) {}
}
