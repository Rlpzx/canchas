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
      Schema::create('imagenes', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('cancha_id');
    $table->string('ruta');          // ruta de la imagen
    $table->boolean('es_principal')->default(false); // indica si esta imagen es principal
    $table->timestamps();

    $table->foreign('cancha_id')
          ->references('id_cancha')
          ->on('canchas')
          ->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes');
    }
};
