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
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('nombre', 20);
            $table->string('descripcion', 50);
            $table->decimal('precio', 8, 2);
            $table->integer('stock')->default(0);
            $table->unsignedInteger('idProveedor')->nullable();
            $table->unsignedInteger('idOptica')->nullable();

            $table->foreign('idProveedor')->references('id')->on('proveedores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idOptica')->references('id')->on('opticas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos');
    }
};
