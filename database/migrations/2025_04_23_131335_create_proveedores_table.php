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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('nombre', 20);
            $table->string('direccion', 40);
            $table->integer('codPostal');
            $table->string('telefono', 15);
            $table->string('correo', 25);
            $table->string('nif', 9);

            $table->unique('nif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
