<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LivroRequest;
use App\Services\LivroService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\LivroResource;

class LivroController extends AbstractController
{

    public function __construct(LivroService $service, LivroRequest $livroRequest)
    {
        parent::__construct($service, $livroRequest);
    }

    public function index(Request $request): JsonResponse
    {
        $request->merge(['with' => ['autores', 'assuntos', 'preco']]);

        $livros = $this->service->getAll($request);

        return LivroResource::collection($livros)->response();
    }

    public function show(int $id): JsonResponse
    {
        $livro = $this->service->getById($id);
        return response()->json(new LivroResource($livro));
    }
}
