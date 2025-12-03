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
    Schema::create('canchas', function (Blueprint $table) {
        $table->id('id_cancha');
        $table->string('nombre', 100);
        $table->string('ubicacion', 150);
        $table->string('tipo', 50);
        $table->text('descripcion')->nullable();
    $table->decimal('precio', 10, 2);
        $table->integer('capacidad')->nullable();
    $table->time('horario_apertura')->nullable();
    $table->time('horario_cierre')->nullable();
    $table->text('servicios')->nullable();
    $table->string('imagen_principal')->nullable();

$table->unsignedBigInteger('id_admin');
$table->foreign('id_admin')->references('id')->on('administradores')->onDelete('cascade');



        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canchas');
    }
};
