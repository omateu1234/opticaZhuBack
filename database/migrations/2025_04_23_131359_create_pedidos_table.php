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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->date('fecha');
            $table->enum('estado', ['pendiente','recibido', 'cancelado'])->default('pendiente');
            $table->string('telefono', 15);
            $table->unsignedInteger('idAuxiliar')->nullable();
            $table->unsignedInteger('idProveedor')->nullable();
            $table->unsignedInteger('idOptica')->nullable();

            $table->foreign('idAuxiliar')->references('id')->on('auxiliares')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idProveedor')->references('id')->on('proveedores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idOptica')->references('id')->on('opticas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
