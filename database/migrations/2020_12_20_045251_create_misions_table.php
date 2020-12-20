<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('misions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->nullable();

            $table->text('descripcion');
            $table->unsignedInteger('ninjas_estimados');
            $table->boolean('urgente');
            $table->enum('estado', ['Pendiente', 'En curso', 'Completado', 'Fallado'])->default('Pendiente');
            $table->text('pago');
            $table->date('fecha_finalizacion');
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
        Schema::dropIfExists('misions');
    }
}
