<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivroAutorTable extends Migration
{
    public function up()
    {
        Schema::create('livro_autor', function (Blueprint $table) {
            $table->integer('Livro_Codl');
            $table->integer('Autor_CodAu');
            $table->timestamps();

            $table->foreign('Livro_Codl')->references('Codl')->on('livro')->onDelete('cascade');
            $table->foreign('Autor_CodAu')->references('CodAu')->on('autor')->onDelete('cascade');

            $table->primary(['Livro_Codl', 'Autor_CodAu']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('livro_autor');
    }
};
