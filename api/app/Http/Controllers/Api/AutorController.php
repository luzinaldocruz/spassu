<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AutorRequest;
use App\Http\Resources\AutorResource;
use App\Services\AutorService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AutorController extends AbstractController
{
    public function __construct(AutorService $service, AutorRequest $autorRequest)
    {
        parent::__construct($service, $autorRequest);
    }

    public function index(Request $request): JsonResponse
    {
        $autores = $this->service->getAll($request);

        return AutorResource::collection($autores)->response();
    }

    public function show(int $id): JsonResponse
    {
        $autor = $this->service->getById($id);
        return response()->json(new AutorResource($autor));
    }
}
