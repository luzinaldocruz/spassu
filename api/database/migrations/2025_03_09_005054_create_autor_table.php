<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorTable extends Migration
{
    public function up()
    {
        Schema::create('autor', function (Blueprint $table) {
            $table->increments('CodAu');
            $table->string('nome', 40);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('autor');
    }
};
