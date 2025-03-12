<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AssuntoRequest;
use App\Services\AssuntoService;
use App\Http\Resources\AssuntoResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssuntoController extends AbstractController
{
    public function __construct(AssuntoService $service, AssuntoRequest $assuntoRequest)
    {
        parent::__construct($service, $assuntoRequest);
    }

    public function index(Request $request): JsonResponse
    {
        $assuntos = $this->service->getAll($request);

        return AssuntoResource::collection($assuntos)->response();
    }

    public function show(int $id): JsonResponse
    {
        $assuntos = $this->service->getById($id);
        return response()->json(new AssuntoResource($assuntos));
    }
}
