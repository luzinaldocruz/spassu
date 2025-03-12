<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

class LivroSwagger
{
    /**
     * @OA\Schema(
     *     schema="Livro",
     *     type="object",
     *     @OA\Property(property="Codl", type="integer", example=135),
     *     @OA\Property(property="Titulo", type="string", example="Livro Novo 11"),
     *     @OA\Property(property="Editora", type="string", example="Editora XPTO"),
     *     @OA\Property(property="Edicao", type="integer", example=2),
     *     @OA\Property(property="AnoPublicacao", type="string", example="2024"),
     *     @OA\Property(property="CreatedAt", type="string", format="date-time", example="2025-03-10 04:18:52"),
     *     @OA\Property(property="UpdatedAt", type="string", format="date-time", example="2025-03-10 04:18:52"),
     *     @OA\Property(property="Preco", type="number", format="float", example=99.9),
     *     @OA\Property(
     *         property="Autores",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/Autor")
     *     ),
     *     @OA\Property(
     *         property="Assuntos",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/Assunto")
     *     )
     * )
     */

    /**
     * @OA\Schema(
     *     schema="Autor",
     *     type="object",
     *     @OA\Property(property="CodAu", type="integer", example=1),
     *     @OA\Property(property="nome", type="string", example="Autor 1")
     * )
     */

    /**
     * @OA\Schema(
     *     schema="Assunto",
     *     type="object",
     *     @OA\Property(property="CodAs", type="integer", example=3),
     *     @OA\Property(property="Descricao", type="string", example="Assunto 3")
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/livros",
     *     summary="Retrieve a list of livros with filters and sorting",
     *     tags={"Livros"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number (Default: 1)",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page (Default: 10)",
     *         required=false,
     *         @OA\Schema(type="integer", example=10)
     *     ),
     *     @OA\Parameter(
     *         name="filter[Codl]",
     *         in="query",
     *         description="Filter by multiple livro IDs (comma-separated, e.g., 3,25)",
     *         required=false,
     *         @OA\Schema(type="string", example="3,25")
     *     ),
     *     @OA\Parameter(
     *         name="filter[Titulo]",
     *         in="query",
     *         description="Filter by livro title (partial match)",
     *         required=false,
     *         @OA\Schema(type="string", example="Livro 2")
     *     ),
     *     @OA\Parameter(
     *         name="filter[CodAu]",
     *         in="query",
     *         description="Filter by author ID (e.g., 19)",
     *         required=false,
     *         @OA\Schema(type="integer", example=19)
     *     ),
     *     @OA\Parameter(
     *         name="filter[CodAs]",
     *         in="query",
     *         description="Filter by multiple subject IDs (comma-separated, e.g., 40,41)",
     *         required=false,
     *         @OA\Schema(type="string", example="40,41")
     *     ),
     *     @OA\Parameter(
     *         name="filter[Preco]",
     *         in="query",
     *         description="Filter by a specific livro price",
     *         required=false,
     *         @OA\Schema(type="number", format="float", example=27)
     *     ),
     *     @OA\Parameter(
     *         name="sort_by",
     *         in="query",
     *         description="Sorting field (e.g., Titulo, Codl, Preco)",
     *         required=false,
     *         @OA\Schema(type="string", example="Titulo")
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
     *         description="List of livros retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Livro")
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *     path="/api/livros",
     *     summary="Create a new Livro",
     *     tags={"Livros"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"Titulo", "Editora", "Edicao", "AnoPublicacao"},
     *             @OA\Property(property="Titulo", type="string", description="Livro title", example="Livro Novo 11"),
     *             @OA\Property(property="Editora", type="string", description="Publisher name", example="Editora XPTO"),
     *             @OA\Property(property="Edicao", type="integer", description="Edition number", example=2),
     *             @OA\Property(property="AnoPublicacao", type="string", description="Publication year", example="2024"),
     *             @OA\Property(property="Preco", type="number", format="float", description="Livro price", example=99.9),
     *             @OA\Property(property="autores", type="array", @OA\Items(type="integer"), description="List of author IDs", example={1, 2}),
     *             @OA\Property(property="assuntos", type="array", @OA\Items(type="integer"), description="List of subject IDs", example={3, 4})
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Livro successfully created",
     *         @OA\JsonContent(ref="#/components/schemas/Livro")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object", example={"Titulo": {"The Titulo field is required."}})
     *         )
     *     )
     * )
     */
    public function store() {}

    /**
     * @OA\Get(
     *     path="/api/livros/{id}",
     *     summary="Retrieve a specific livro by its ID",
     *     tags={"Livros"},
     *     @OA\Parameter(
     *         name="Codl",
     *         in="path",
     *         description="Codl of the livro to retrieve",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Livro details retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Livro")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Livro not found"
     *     )
     * )
     */
    public function show() {}

    /**
     * @OA\Put(
     *     path="/api/livros/{id}",
     *     summary="Update an existing livro",
     *     tags={"Livros"},
     *     @OA\Parameter(
     *         name="Codl",
     *         in="path",
     *         description="Codl of the livro to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"Titulo", "Editora", "Edicao", "AnoPublicacao"},
     *             @OA\Property(property="Titulo", type="string", description="Updated livro title", example="Livro Atualizado"),
     *             @OA\Property(property="Editora", type="string", description="Updated publisher name", example="Editora XYZ"),
     *             @OA\Property(property="Edicao", type="integer", description="Updated edition number", example=3),
     *             @OA\Property(property="AnoPublicacao", type="string", description="Updated publication year", example="2023"),
     *             @OA\Property(property="Preco", type="number", format="float", description="Updated livro price", example=89.9),
     *             @OA\Property(property="autores", type="array", @OA\Items(type="integer"), description="List of author IDs", example={1, 2}),
     *             @OA\Property(property="assuntos", type="array", @OA\Items(type="integer"), description="List of subject IDs", example={3, 4})
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Livro updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Livro")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Livro not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object", example={"Titulo": {"The Titulo field is required."}})
     *         )
     *     )
     * )
     */
    public function update() {}

    /**
     * @OA\Patch(
     *     path="/api/livros/{id}",
     *     summary="Partially update an existing livro",
     *     tags={"Livros"},
     *     @OA\Parameter(
     *         name="Codl",
     *         in="path",
     *         description="Codl of the livro to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="Titulo", type="string", description="Updated livro title", example="Livro Updated"),
     *             @OA\Property(property="Editora", type="string", description="Updated publisher name", example="Editora ABC"),
     *             @OA\Property(property="Edicao", type="integer", description="Updated edition number", example=4),
     *             @OA\Property(property="AnoPublicacao", type="string", description="Updated publication year", example="2022"),
     *             @OA\Property(property="Preco", type="number", format="float", description="Updated livro price", example=79.9),
     *             @OA\Property(property="autores", type="array", @OA\Items(type="integer"), description="List of author IDs", example={1, 2}),
     *             @OA\Property(property="assuntos", type="array", @OA\Items(type="integer"), description="List of subject IDs", example={3, 4})
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Livro updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Livro")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Livro not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *         )
     *     )
     * )
     */
    public function patch() {}

    /**
     * @OA\Delete(
     *     path="/api/livros/{id}",
     *     summary="Delete an existing livro",
     *     tags={"Livros"},
     *     @OA\Parameter(
     *         name="Codl",
     *         in="path",
     *         description="Codl of the livro to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Livro deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Livro not found"
     *     )
     * )
     */
    public function destroy() {}
}
