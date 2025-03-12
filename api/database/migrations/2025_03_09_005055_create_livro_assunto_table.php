<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivroAssuntoTable extends Migration
{
    public function up()
    {
        Schema::create('livro_assunto', function (Blueprint $table) {
            $table->integer('Livro_Codl');
            $table->integer('Assunto_CodAs');
            $table->timestamps();

            $table->foreign('Livro_Codl')->references('Codl')->on('livro')->onDelete('cascade');
            $table->foreign('Assunto_CodAs')->references('CodAs')->on('assunto')->onDelete('cascade');

            $table->primary(['Livro_Codl', 'Assunto_CodAs']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('livro_assunto');
    }
};
