<?php

namespace App\Http\Controllers\Api;

use App\Services\AbstractService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

abstract class AbstractController
{
    protected $service;
    protected $request;

    public function __construct(AbstractService $service, Request $request = null)
    {
        $this->service = $service;
        $this->request = $request;
    }

    public function index(Request $request): JsonResponse
    {
        $data = $this->service->getAll($request);
        return response()->json($data);
    }

    public function store(): JsonResponse
    {
        $item = $this->service->create($this->request->all());
        return response()->json($item, 201);
    }

    public function show(int $id): JsonResponse
    {
        $item = $this->service->getById($id);
        return response()->json($item);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = $this->service->update($id, $request->all());
        return response()->json($item);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
