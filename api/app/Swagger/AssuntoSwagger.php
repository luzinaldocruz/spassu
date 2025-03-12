<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

class AssuntoSwagger
{
    /**
     * @OA\Get(
     *     path="/api/assuntos",
     *     summary="Retrieve a list of assuntos",
     *     description="This endpoint retrieves a paginated list of assuntos, with optional filters and pagination.",
     *     tags={"Assuntos"},
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer", example=10)
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="filter[Descricao]",
     *         in="query",
     *         description="Filter the list by the 'Descricao' field",
     *         required=false,
     *         @OA\Schema(type="string", example="Assunto")
     *     ),
     *     @OA\Parameter(
     *         name="sort_by",
     *         in="query",
     *         description="Sorting field (e.g., Descricao)",
     *         required=false,
     *         @OA\Schema(type="string", example="Descricao")
     *     ),
     *     @OA\Parameter(
     *         name="sort_dir",
     *         in="query",
     *         description="Sorting direction (asc or desc)",
     *         required=false,
     *         @OA\Schema(type="string", enum={"asc", "desc"}, example="asc")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of assuntos retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Assunto")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request due to invalid query parameters",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Invalid query parameters.")
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *     path="/api/assuntos",
     *     summary="Create a new Assunto",
     *     tags={"Assuntos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"Descricao"},
     *             @OA\Property(property="Descricao", type="string", example="Novo Assunto")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Assunto successfully created",
     *         @OA\JsonContent(ref="#/components/schemas/Assunto")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object", example={"Descricao": {"The Descricao field is required."}})
     *         )
     *     )
     * )
     */
    public function store() {}

    /**
     * @OA\Get(
     *     path="/api/assuntos/{id}",
     *     summary="Retrieve a specific assunto by its ID",
     *     tags={"Assuntos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="codAs of the assunto to retrieve",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Assunto details retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Assunto")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Assunto not found"
     *     )
     * )
     */
    public function show() {}

    /**
     * @OA\Put(
     *     path="/api/assuntos/{id}",
     *     summary="Update an existing assunto",
     *     tags={"Assuntos"},
     *     @OA\Parameter(
     *         name="codAs",
     *         in="path",
     *         description="codAs of the assunto to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"Descricao"},
     *             @OA\Property(property="Descricao", type="string", example="Assunto Atualizado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Assunto updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Assunto")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Assunto not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object", example={"Descricao": {"The Descricao field is required."}})
     *         )
     *     )
     * )
     */
    public function update() {}

    /**
     * @OA\Patch(
     *     path="/api/assuntos/{id}",
     *     summary="Partially update an existing assunto",
     *     tags={"Assuntos"},
     *     @OA\Parameter(
     *         name="codAs",
     *         in="path",
     *         description="codAs of the assunto to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="Descricao", type="string", description="Updated description of the assunto", example="Assunto Atualizado Parcialmente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Assunto partially updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Assunto")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Assunto not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object", example={"Descricao": {"The Descricao field is required."}})
     *         )
     *     )
     * )
     */
    public function patch() {}

    /**
     * @OA\Delete(
     *     path="/api/assuntos/{id}",
     *     summary="Delete an existing assunto",
     *     tags={"Assuntos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="codAs of the assunto to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Assunto deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Assunto not found"
     *     )
     * )
     */
    public function destroy() {}
}
