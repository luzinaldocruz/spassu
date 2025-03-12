<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\DTOs\AutorDTO;

class AutorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $autorDTO = new AutorDTO(
            $this->CodAu,
            $this->nome
        );

        return (array) $autorDTO;
    }
}
