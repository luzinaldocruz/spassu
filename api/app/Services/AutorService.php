<?php

namespace App\Services;

use App\Repositories\AutorRepository;

class AutorService extends AbstractService
{
    public function __construct(AutorRepository $repository)
    {
        parent::__construct($repository);
    }
}
