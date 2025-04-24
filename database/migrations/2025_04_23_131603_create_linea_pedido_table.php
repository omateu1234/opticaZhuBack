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
        Schema::create('linea_pedido', function (Blueprint $table) {
            $table->increments('id')->primary();
            /* $table->date('fecha'); */
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 8, 2);
            $table->decimal('importe', 8, 2);
            $table->unsignedInteger('idPedido')->nullable();
            $table->unsignedInteger('idArticulo')->nullable();

            $table->foreign('idPedido')->references('id')->on('pedidos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idArticulo')->references('id')->on('articulos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linea_pedido');
    }
};
