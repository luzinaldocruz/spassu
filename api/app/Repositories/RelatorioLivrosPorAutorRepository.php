<?php

namespace App\Repositories;

use App\Models\VwLivrosAutoresAssuntos;
use Illuminate\Support\Collection;

class RelatorioLivrosPorAutorRepository extends AbstractRepository
{
    public function __construct(VwLivrosAutoresAssuntos $model)
    {
        parent::__construct($model);
    }
}
