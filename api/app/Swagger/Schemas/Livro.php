<?php

namespace App\Swagger\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Livro",
 *     type="object",
 *     title="Livro",
 *     description="Livro",
 *     @OA\Property(property="Codl", type="integer", description="Livro ID"),
 *     @OA\Property(property="Titulo", type="string", description="Livro title"),
 *     @OA\Property(property="Editora", type="string", description="Publisher name"),
 *     @OA\Property(property="Edicao", type="integer", description="Edition number"),
 *     @OA\Property(property="AnoPublicacao", type="string", description="Publication year"),
 *     @OA\Property(property="Preco", type="number", format="float", description="Livro price"),
 *     @OA\Property(
 *         property="Autores",
 *         type="array",
 *         description="List of authors",
 *         @OA\Items(
 *             @OA\Property(property="CodAu", type="integer", description="Author ID"),
 *             @OA\Property(property="Nome", type="string", description="Author name")
 *         )
 *     ),
 *     @OA\Property(
 *         property="Assuntos",
 *         type="array",
 *         description="List of subjects",
 *         @OA\Items(
 *             @OA\Property(property="CodAs", type="integer", description="Subject ID"),
 *             @OA\Property(property="Descricao", type="string", description="Subject description")
 *         )
 *     )
 * )
 */
class Livro {}
