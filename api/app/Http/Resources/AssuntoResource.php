<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\DTOs\AssuntoDTO;

class AssuntoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $assuntoDTO = new AssuntoDTO(
            $this->CodAs,
            $this->descricao
        );

        return (array) $assuntoDTO;
    }
}
