<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

class AutorSwagger
{
    /**
     * @OA\Get(
     *     path="/api/autores",
     *     summary="Retrieve a list of authors",
     *     description="This endpoint retrieves a paginated list of authors, with optional filters and pagination.",
     *     tags={"Autores"},
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
     *         name="filter[nome]",
     *         in="query",
     *         description="Filter the list by the 'nome' field",
     *         required=false,
     *         @OA\Schema(type="string", example="Autor")
     *     ),
     *     @OA\Parameter(
     *         name="sort_by",
     *         in="query",
     *         description="Sorting field (e.g., nome)",
     *         required=false,
     *         @OA\Schema(type="string", example="nome")
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
     *         description="List of authors retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Autor")
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
     *     path="/api/autores",
     *     summary="Create a new author",
     *     tags={"Autores"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome"},
     *             @OA\Property(property="nome", type="string", example="Novo Autor")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Author successfully created",
     *         @OA\JsonContent(ref="#/components/schemas/Autor")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object", example={"nome": {"The nome field is required."}})
     *         )
     *     )
     * )
     */
    public function store() {}

    /**
     * @OA\Get(
     *     path="/api/autores/{id}",
     *     summary="Retrieve a specific author by its ID",
     *     tags={"Autores"},
     *     @OA\Parameter(
     *         name="CodAu",
     *         in="path",
     *         description="CodAu of the author to retrieve",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Author details retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Autor")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Author not found"
     *     )
     * )
     */
    public function show() {}

    /**
     * @OA\Put(
     *     path="/api/autores/{id}",
     *     summary="Update an existing author",
     *     tags={"Autores"},
     *     @OA\Parameter(
     *         name="CodAu",
     *         in="path",
     *         description="CodAu of the author to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome"},
     *             @OA\Property(property="nome", type="string", example="Autor Atualizado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Author updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Autor")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Author not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object", example={"nome": {"The nome field is required."}})
     *         )
     *     )
     * )
     */
    public function update() {}

    /**
     * @OA\Patch(
     *     path="/api/autores/{id}",
     *     summary="Partially update an existing author",
     *     tags={"Autores"},
     *     @OA\Parameter(
     *         name="CodAu",
     *         in="path",
     *         description="CodAu of the author to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string", description="Updated name of the author", example="Autor Atualizado Parcialmente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Author partially updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Autor")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Author not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object", example={"nome": {"The nome field is required."}})
     *         )
     *     )
     * )
     */
    public function patch() {}

    /**
     * @OA\Delete(
     *     path="/api/autores/{id}",
     *     summary="Delete an existing author",
     *     tags={"Autores"},
     *     @OA\Parameter(
     *         name="CodAu",
     *         in="path",
     *         description="CodAu of the author to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Author deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Author not found"
     *     )
     * )
     */
    public function destroy() {}
}
