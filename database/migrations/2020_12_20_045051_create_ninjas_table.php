<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNinjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ninjas', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 100);
            $table->text('habilidades');
            $table->enum('rango', ['novato', 'soldado', 'veterano', 'maestro']);
            $table->enum('estado', ['activo', 'retirado', 'fallecido', 'desertor']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ninjas');
    }
}
