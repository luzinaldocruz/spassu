<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivroPrecoTable extends Migration
{
    public function up()
    {
        Schema::create('livro_preco', function (Blueprint $table) {
            $table->integer('Livro_Codl');
            $table->decimal('Preco', 10, 2);
            $table->timestamp('Data');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('Livro_Codl')->references('Codl')->on('livro')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('livro_preco');
    }
};
