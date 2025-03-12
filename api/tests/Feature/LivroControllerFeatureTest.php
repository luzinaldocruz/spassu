<?php

namespace Tests\Feature;

use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LivroControllerFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreLivro()
    {
        $livroData = [
            'Titulo' => 'Livro Teste',
            'Editora' => 'Editora Teste',
            'Edicao' => 1,
            'AnoPublicacao' => 2023,
        ];

        $response = $this->postJson('/api/livros', $livroData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('livro', $livroData);

        $response->assertJsonStructure([
            'Codl',
            'Titulo',
            'Editora',
            'Edicao',
            'AnoPublicacao',
        ]);
    }

    public function testUpdateLivro()
    {
        $livro = Livro::factory()->create();

        $updatedData = [
            'Titulo' => 'Livro Atualizado',
            'Editora' => 'Editora Atualizada',
            'Edicao' => 2,
            'AnoPublicacao' => 2024,
        ];

        $response = $this->putJson("/api/livros/{$livro->Codl}", $updatedData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('livro', $updatedData);

        $response->assertJsonStructure([
            'Codl',
            'Titulo',
            'Editora',
            'Edicao',
            'AnoPublicacao',
        ]);
    }

    // public function testUpdateLivroNotFound()
    // {
    //     // ID de um livro que não existe
    //     $id = 999;

    //     // Dados atualizados do livro
    //     $updatedData = [
    //         'Titulo' => 'Livro Atualizado',
    //         'Editora' => 'Editora Atualizada',
    //         'Edicao' => 2,
    //         'AnoPublicacao' => 2024,
    //     ];

    //     // Faz uma requisição PUT para a rota de atualização de livro
    //     $response = $this->putJson("/api/livros/{$id}", $updatedData);

    //     // Verifica o status da resposta
    //     $response->assertStatus(404);

    //     // Verifica a mensagem de erro
    //     $response->assertJson([
    //         'message' => 'Livro not found',
    //     ]);
    // }
}
