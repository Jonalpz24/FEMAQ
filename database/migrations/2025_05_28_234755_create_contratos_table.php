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
    Schema::create('contratos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
        $table->foreignId('producto_id')->constrained()->onDelete('cascade');
        $table->integer('cantidad')->default(1);
        $table->decimal('total_costo', 10, 2);
        $table->date('fecha_contrato')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
