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
    Schema::create('detallepagos', function (Blueprint $table) {
        $table->id('id_detalle');
        $table->string('concepto', 100);
        $table->integer('cantidad');
        $table->decimal('precio_unit', 10, 2);
        $table->decimal('subtotal', 10, 2);

        $table->unsignedBigInteger('id_pago');
        $table->foreign('id_pago')->references('id_pago')->on('pagos')->onDelete('cascade');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallepagos');
    }
};
