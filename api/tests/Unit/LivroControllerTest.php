<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\LivroController;
use App\Http\Requests\LivroRequest;
use App\Services\LivroService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;
use Mockery;
use stdClass;
use Illuminate\Support\Collection;

class LivroControllerTest extends TestCase
{
    protected $livroServiceMock;
    protected $livroRequestMock;
    protected $livroController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->livroServiceMock = Mockery::mock(LivroService::class);

        $this->livroRequestMock = Mockery::mock(LivroRequest::class);

        $this->livroController = new LivroController($this->livroServiceMock, $this->livroRequestMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testIndex()
    {
        $request = new Request();
        $request->merge(['with' => ['autores', 'assuntos', 'preco']]);

        $livro1 = new stdClass();
        $livro1->Codl = 1;
        $livro1->Titulo = 'Livro 1';
        $livro1->Editora = 'Editora A';
        $livro1->Edicao = 1;
        $livro1->AnoPublicacao = 2023;
        $livro1->created_at = now();
        $livro1->updated_at = now();

        $preco1 = new stdClass();
        $preco1->Preco = 29.99;
        $livro1->preco = $preco1;

        $autor1 = new stdClass();
        $autor1->CodAu = 11;
        $autor1->nome = 'Autor 11';
        $livro1->autores = collect([$autor1]);

        $assunto1 = new stdClass();
        $assunto1->CodAs = 10;
        $assunto1->descricao = 'Assunto 10';
        $livro1->assuntos = collect([$assunto1]);

        $livro2 = new stdClass();
        $livro2->Codl = 2;
        $livro2->Titulo = 'Livro 2';
        $livro2->Editora = 'Editora B';
        $livro2->Edicao = 2;
        $livro2->AnoPublicacao = 2022;
        $livro2->created_at = now();
        $livro2->updated_at = now();

        $preco2 = new stdClass();
        $preco2->Preco = 39.99;
        $livro2->preco = $preco2;

        $livro2->autores = collect([]);
        $livro2->assuntos = collect([]);

        $livros = collect([$livro1, $livro2]);

        $this->livroServiceMock
            ->shouldReceive('getAll')
            ->with($request)
            ->andReturn($livros);

        $response = $this->livroController->index($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testShow()
    {
        $id = 1;

        $livro = new stdClass();
        $livro->Codl = 1;
        $livro->Titulo = 'Livro 1';
        $livro->Editora = 'Editora A';
        $livro->Edicao = 1;
        $livro->AnoPublicacao = 2023;
        $livro->created_at = now();
        $livro->updated_at = now();

        $preco = new stdClass();
        $preco->Preco = 29.99;
        $livro->preco = $preco;

        $autor1 = new stdClass();
        $autor1->CodAu = 11;
        $autor1->nome = 'Autor 11';
        $livro->autores = collect([$autor1]);

        $assunto1 = new stdClass();
        $assunto1->CodAs = 10;
        $assunto1->descricao = 'Assunto 10';
        $livro->assuntos = collect([$assunto1]);

        $this->livroServiceMock
            ->shouldReceive('getById')
            ->with($id)
            ->andReturn($livro);

        $response = $this->livroController->show($id);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDestroy()
    {
        $id = 1;

        $this->livroServiceMock
            ->shouldReceive('delete')
            ->with($id)
            ->andReturnNull();

        $response = $this->livroController->destroy($id);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function testStoreSuccess()
    {
        $livroData = [
            'Titulo' => 'Livro Teste',
            'Editora' => 'Editora Teste',
            'Edicao' => 1,
            'AnoPublicacao' => 2023,
        ];

        $livroCriado = new stdClass();
        $livroCriado->Codl = 1;
        $livroCriado->Titulo = 'Livro Teste';
        $livroCriado->Editora = 'Editora Teste';
        $livroCriado->Edicao = 1;
        $livroCriado->AnoPublicacao = 2023;
        $livroCriado->created_at = now();
        $livroCriado->updated_at = now();

        $this->livroRequestMock
            ->shouldReceive('all')
            ->andReturn($livroData);

        $this->livroServiceMock
            ->shouldReceive('create')
            ->with($livroData)
            ->andReturn($livroCriado);

        $response = $this->livroController->store();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals(json_encode($livroCriado), $response->getContent());
    }

    public function testStoreFailure()
    {
        $livroData = [
            'Titulo' => 'Livro Teste',
            'Editora' => 'Editora Teste',
            'Edicao' => 1,
            'AnoPublicacao' => 2023,
        ];

        $this->livroRequestMock
            ->shouldReceive('all')
            ->andReturn($livroData);

        $this->livroServiceMock
            ->shouldReceive('create')
            ->with($livroData)
            ->andThrow(new \Exception('Error'));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Error');

        $this->livroController->store();
    }

    public function testUpdateSuccess()
    {
        $id = 1;
        $livroData = [
            'Titulo' => 'Livro Atualizado',
            'Editora' => 'Editora Atualizada',
            'Edicao' => 2,
            'AnoPublicacao' => 2024,
        ];

        $livroAtualizado = new stdClass();
        $livroAtualizado->Codl = 1;
        $livroAtualizado->Titulo = 'Livro Atualizado';
        $livroAtualizado->Editora = 'Editora Atualizada';
        $livroAtualizado->Edicao = 2;
        $livroAtualizado->AnoPublicacao = 2024;
        $livroAtualizado->created_at = now();
        $livroAtualizado->updated_at = now();

        $this->livroServiceMock
            ->shouldReceive('update')
            ->with($id, $livroData)
            ->andReturn($livroAtualizado);

        $request = new Request($livroData);
        $response = $this->livroController->update($request, $id);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(json_encode($livroAtualizado), $response->getContent());
    }

    public function testUpdateFailure()
    {
        $id = 1;
        $livroData = [
            'Titulo' => 'Livro Atualizado',
            'Editora' => 'Editora Atualizada',
            'Edicao' => 2,
            'AnoPublicacao' => 2024,
        ];

        $this->livroServiceMock
            ->shouldReceive('update')
            ->with($id, $livroData)
            ->andThrow(new \Exception('Error'));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Error');

        $request = new Request($livroData);
        $this->livroController->update($request, $id);
    }
}
