<?php

namespace App\Swagger\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Autor",
 *     type="object",
 *     title="Autor",
 *     description="Autor",
 *     @OA\Property(property="CodAu", type="integer", description="Autor ID"),
 *     @OA\Property(property="Nome", type="string", description="Autor name")
 * )
 */
class Autor {}
