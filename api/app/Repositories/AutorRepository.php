<?php

namespace App\Repositories;

use App\Models\Autor;

class AutorRepository extends AbstractRepository
{
    public function __construct(Autor $model)
    {
        parent::__construct($model);
    }
}
