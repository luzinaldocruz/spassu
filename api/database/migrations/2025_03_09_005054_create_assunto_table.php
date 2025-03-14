<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssuntoTable extends Migration
{
    public function up()
    {
        Schema::create('assunto', function (Blueprint $table) {
            $table->increments('CodAs');
            $table->string('descricao', 20);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assunto');
    }
};
