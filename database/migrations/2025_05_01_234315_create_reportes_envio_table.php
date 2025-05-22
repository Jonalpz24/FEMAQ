<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportesEnvioTable extends Migration
{
    public function up()
    {
        Schema::create('reportes_envio', function (Blueprint $table) {
            $table->id();
            $table->string('proveedor');
            $table->date('fecha');
            $table->decimal('total_envio', 10, 2)->default(0);
            $table->foreignId('creado_por')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reportes_envio');
    }
}