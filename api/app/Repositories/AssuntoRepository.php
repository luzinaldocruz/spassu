<?php

namespace App\Repositories;

use App\Models\Assunto;

class AssuntoRepository extends AbstractRepository
{
    public function __construct(Assunto $model)
    {
        parent::__construct($model);
    }
}
