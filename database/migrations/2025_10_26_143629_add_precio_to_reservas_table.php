<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservas', function (Blueprint $table) {
            // precio como decimal(10,2) y nullable por si hay reservas sin precio
            $table->decimal('precio', 10, 2)->nullable()->after('hora_fin');
        });
    }

    public function down()
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropColumn('precio');
        });
    }
};
