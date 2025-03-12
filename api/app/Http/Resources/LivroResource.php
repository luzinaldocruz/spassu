<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\DTOs\LivroDTO;
use App\DTOs\AutorDTO;
use App\DTOs\AssuntoDTO;

class LivroResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $autores = $this->autores->map(function ($autor) {
            return new AutorDTO(
                $autor->CodAu,
                $autor->nome
            );
        })->toArray();

        $assuntos = $this->assuntos->map(function ($assunto) {
            return new AssuntoDTO(
                $assunto->CodAs,
                $assunto->descricao
            );
        })->toArray();

        return (array) new LivroDTO(
            $this->Codl,
            $this->Titulo,
            $this->Editora,
            $this->Edicao,
            $this->AnoPublicacao,
            $this->created_at,
            $this->updated_at,
            $this->preco ? $this->preco->Preco : 0,
            $autores,
            $assuntos
        );
    }
}
