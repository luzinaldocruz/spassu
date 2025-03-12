<?php

namespace App\Services;

use App\Repositories\RelatorioLivrosPorAutorRepository;

class RelatorioLivrosPorAutorService extends AbstractService
{
    public function __construct(RelatorioLivrosPorAutorRepository $repository)
    {
        parent::__construct($repository);
    }
}
