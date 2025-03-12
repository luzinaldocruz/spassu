<?php

namespace Database\Factories;

use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use Illuminate\Database\Eloquent\Factories\Factory;

class LivroFactory extends Factory
{
    protected $model = Livro::class;

    public function definition()
    {
        return [
            'Titulo' => $this->faker->sentence(3),
            'Editora' => $this->faker->sentence(1),
            'Edicao' =>  $this->faker->numberBetween(1, 10),
            'AnoPublicacao' => $this->faker->year,
        ];
    }
}
