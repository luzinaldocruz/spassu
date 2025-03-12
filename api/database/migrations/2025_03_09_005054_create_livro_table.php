<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivroTable extends Migration
{
    public function up()
    {
        Schema::create('livro', function (Blueprint $table) {
            $table->increments('Codl');
            $table->string('Titulo', 40);
            $table->string('Editora', 40);
            $table->integer('Edicao');
            $table->string('AnoPublicacao', 4);
            $table->timestamps();

            $table->index(['Codl', 'Titulo']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('livro');
    }
};
