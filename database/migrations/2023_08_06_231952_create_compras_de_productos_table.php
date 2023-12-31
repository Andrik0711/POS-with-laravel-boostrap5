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
        Schema::create('compras_de_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compra_id')->constrained('compras');
            $table->foreignId('producto_id')->constrained('productos');
            $table->integer('cantidad_comprada');
            $table->decimal('precio_unitario', 8, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras_de_productos');
    }
};
