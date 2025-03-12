<?php

namespace App\Services;

use App\Repositories\AssuntoRepository;

class AssuntoService extends AbstractService
{
    public function __construct(AssuntoRepository $repository)
    {
        parent::__construct($repository);
    }
}
