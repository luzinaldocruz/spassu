<?php

namespace App\Swagger\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Assunto",
 *     type="object",
 *     title="Assunto",
 *     description="Assunto",
 *     @OA\Property(property="CodAs", type="integer", description="Assunto ID"),
 *     @OA\Property(property="Descricao", type="string", description="Assunto description")
 * )
 */
class Assunto {}
