<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('reservas', function (Blueprint $table) {
        $table->id('id_reserva');
        $table->date('fecha');
        $table->time('hora_inicio');
        $table->time('hora_fin');
        $table->string('estado', 50);

        $table->unsignedBigInteger('id_cancha');
        $table->foreign('id_cancha')->references('id_cancha')->on('canchas')->onDelete('cascade');

        $table->unsignedBigInteger('id_usuario');
        $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
