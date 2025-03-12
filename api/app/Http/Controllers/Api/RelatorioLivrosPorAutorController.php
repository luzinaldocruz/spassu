<?php

namespace App\Http\Controllers\Api;

use App\Services\RelatorioLivrosPorAutorService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RelatorioLivrosPorAutorController extends AbstractController
{
    public function __construct(RelatorioLivrosPorAutorService $service)
    {
        parent::__construct($service);
    }

    public function index(Request $request): JsonResponse
    {
        $relatorio = $this->service->getAll($request);

        return response()->json($relatorio);
    }
}
