<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class AbstractRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll($request): LengthAwarePaginator | Collection
    {
        $query = $this->model->query();

        if ($request->has('with')) {
            $query->with($request->get('with'));
        }

        // if ($request->has('filter')) {
        //     foreach ($request->get('filter') as $field => $value) {
        //         $values = is_array($value) ? $value : explode(',', str_replace(' ', '', $value));
        //         $values = array_filter(array_map('trim', $values));

        //         $relations = $this->getFilterableRelations();

        //         if (array_key_exists($field, $relations)) {
        //             $relation = $relations[$field]['relation'];
        //             $column = $relations[$field]['column'];

        //             $query->whereHas($relation, function ($q) use ($column, $values) {
        //                 $q->whereIn($column, $values);
        //             });
        //         } elseif (in_array($field, $this->model->getFillable())) {
        //             if (count($values) > 1) {
        //                 $query->whereIn($field, $values);
        //             } else {
        //                 if ($this->isNumericField($field)) {
        //                     $query->where($field, '=', $values[0]);
        //                 } else {
        //                     $query->where($field, 'ILIKE', '%' . $values[0] . '%');
        //                 }
        //             }
        //         }
        //     }
        // }


        if ($request->has('filter')) {
            foreach ($request->get('filter') as $field => $value) {
                // Verifica se o campo é numérico
                $isNumeric = $this->isNumericField($field);

                // Se o campo não for numérico, mantemos o valor original
                if (!$isNumeric) {
                    $values = [$value]; // Mantém o valor original como um array
                } else {
                    // Para campos numéricos, processamos o valor como antes
                    $values = is_array($value) ? $value : explode(',', str_replace(' ', '', $value));
                    $values = array_filter(array_map('trim', $values));
                }

                $relations = $this->getFilterableRelations();

                if (array_key_exists($field, $relations)) {
                    $relation = $relations[$field]['relation'];
                    $column = $relations[$field]['column'];

                    $query->whereHas($relation, function ($q) use ($column, $values) {
                        $q->whereIn($column, $values);
                    });
                } elseif (in_array($field, $this->model->getFillable())) {
                    if (count($values) > 1) {
                        $query->whereIn($field, $values);
                    } else {
                        if ($isNumeric) {
                            $query->where($field, '=', $values[0]);
                        } else {
                            $query->where($field, 'ILIKE', '%' . $values[0] . '%');
                        }
                    }
                }
            }
        }

        $results = $query->get();

        $sortBy = $request->get('sort_by');
        $sortDirection = strtolower($request->get('sort_dir', 'asc')) === 'desc';

        if ($sortBy) {
            $results = $results->sortBy(function ($item) use ($sortBy) {
                return data_get($item, str_replace(['[', ']'], '.', $sortBy));
            }, SORT_NATURAL | SORT_FLAG_CASE, $sortDirection);
        }

        if (!$request->has('no_pagination') || !$request->no_pagination) {
            return $this->paginateCollection($results, $request->get('per_page', 15));
        }

        return $results->values();
    }

    protected function paginateCollection(Collection $items, int $perPage): LengthAwarePaginator
    {
        $currentPage = request()->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $paginatedItems = $items->slice($offset, $perPage)->values();

        return new LengthAwarePaginator(
            $paginatedItems,
            $items->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    protected function getFilterableRelations(): array
    {
        return [];
    }

    protected function isNumericField(string $field): bool
    {
        if (!$this->model->getConnection()->getSchemaBuilder()->hasColumn($this->model->getTable(), $field)) {
            return false;
        }

        $numericTypes = ['integer', 'int4', 'bigint', 'smallint', 'decimal', 'numeric', 'float', 'double'];

        $columnType = $this->model->getConnection()->getSchemaBuilder()->getColumnType($this->model->getTable(), $field);

        return in_array($columnType, $numericTypes);
    }

    public function getById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $item = $this->getById($id);
        $item->update($data);
        return $item;
    }

    public function delete(int $id)
    {
        $this->model->destroy($id);
    }
}
