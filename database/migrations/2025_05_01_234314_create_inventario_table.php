<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioTable extends Migration
{
    public function up()
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->foreignId('bodega_id')->constrained('bodegas')->onDelete('cascade');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventario');
    }
}