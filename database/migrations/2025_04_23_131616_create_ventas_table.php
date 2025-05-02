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
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->date('fecha');
           /*  $table->decimal('importe', 8, 2); */
            $table->enum('estado', ['pendiente','recibido', 'cancelado'])->default('pendiente');
            $table->enum('metodoPago', ['efectivo', 'tarjeta', 'transferencia'])->default('transferencia');
            $table->unsignedInteger('idOptica')->nullable();
            $table->unsignedInteger('idCliente')->nullable();

            $table->foreign('idOptica')->references('id')->on('opticas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
