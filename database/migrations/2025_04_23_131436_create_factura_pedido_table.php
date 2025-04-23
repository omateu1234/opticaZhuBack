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
        Schema::create('factura_pedido', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->date('fecha');
            $table->enum('estadoPago', ['pendiente','pagado', 'cancelado']);
            $table->unsignedInteger('idPedido')->nullable();

            $table->foreign('idPedido')->references('id')->on('pedidos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_pedido');
    }
};
