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

    public function delete(int $id)
    {
        return DB::transaction(function () use ($id) {
            $livro = $this->repository->getById($id);

            $livro->autores()->detach();
            $livro->assuntos()->detach();
            $livro->preco()->delete();

            $livro->delete();

            return true;
        });
    }
}
