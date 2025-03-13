<?php

namespace App\Services;

use App\Repositories\LivroRepository;
use Illuminate\Support\Facades\DB;

class LivroService extends AbstractService
{
    public function __construct(LivroRepository $repository)
    {
        parent::__construct($repository);
    }
}
