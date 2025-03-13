<?php

namespace App\Repositories;

use App\Models\Livro;
use App\Http\Resources\LivroResource;
use App\Models\LivroPreco;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class LivroRepository extends AbstractRepository
{
    public function __construct(Livro $model)
    {
        parent::__construct($model);
    }

    protected function getFilterableRelations(): array
    {
        return [
            'CodAu' => ['relation' => 'autores', 'column' => 'CodAu'],
            'CodAs' => ['relation' => 'assuntos', 'column' => 'CodAs'],
            'Preco' => ['relation' => 'preco', 'column' => 'Preco'],
        ];
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $livroData = array_diff_key($data, array_flip(['autores', 'assuntos', 'Preco']));

            $livro = parent::create($livroData);

            if (!empty($data['autores'])) {
                $livro->autores()->attach($data['autores']);
            }

            if (!empty($data['assuntos'])) {
                $livro->assuntos()->attach($data['assuntos']);
            }

            if (!empty($data['Preco'])) {
                LivroPreco::where('Livro_Codl', $livro->Codl)->update(['deleted_at' => now()]);

                $livro->preco()->create([
                    'Livro_Codl' => $livro->Codl,
                    'Preco' => $data['Preco'],
                    'Data' => now(),
                ]);
            }

            $livro->load(['autores', 'assuntos', 'preco']);

            return new LivroResource($livro);
        });
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $livro = Livro::findOrFail($id);

            $livroData = array_diff_key($data, ['Preco' => '']);
            $livro->update($livroData);

            if (isset($data['autores'])) {
                $livro->autores()->sync($data['autores']);
            }

            if (isset($data['assuntos'])) {
                $livro->assuntos()->sync($data['assuntos']);
            }

            if (isset($data['Preco'])) {
                $precoAtual = LivroPreco::where('Livro_Codl', $id)
                    ->whereNull('deleted_at')
                    ->latest('Data')
                    ->first();

                if (!$precoAtual || $precoAtual->Preco != $data['Preco']) {
                    LivroPreco::where('Livro_Codl', $id)
                        ->whereNull('deleted_at')
                        ->update(['deleted_at' => now()]);

                    $livro->preco()->create([
                        'Livro_Codl' => $livro->Codl,
                        'Preco' => $data['Preco'],
                        'Data' => now(),
                    ]);
                }
            }

            $livro->load(['autores', 'assuntos', 'preco']);

            return new LivroResource($livro);
        });
    }

    public function delete(int $id)
    {
        return DB::transaction(function () use ($id) {
            $livro = Livro::findOrFail($id);

            $livro->autores()->detach();
            $livro->assuntos()->detach();
            $livro->preco()->delete();

            $livro->delete();

            return true;
        });
    }
}
