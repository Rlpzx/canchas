<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 🔹 Desactiva restricciones mientras crea la tabla
        Schema::disableForeignKeyConstraints();

        Schema::create('pagos', function (Blueprint $table) {
            $table->id('id_pago');
            $table->unsignedBigInteger('id_reserva');
            $table->decimal('monto', 10, 2);
            $table->date('fecha_pago');
            $table->string('metodo_pago', 50);
            $table->string('estado_pago', 50);

            // 🔹 Clave foránea hacia reservas
            $table->foreign('id_reserva')
                ->references('id_reserva')
                ->on('reservas')
                ->onDelete('cascade');

            $table->timestamps();
        });

        // 🔹 Reactiva las restricciones al final del método up
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
