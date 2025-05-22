<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleReporteEnvioTable extends Migration
{
    public function up()
    {
        Schema::create('detalle_reporte_envio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reporte_envio_id') // clave foránea
                  ->constrained('reportes_envio')
                  ->onDelete('cascade');
            $table->foreignId('producto_id')
                  ->constrained('productos')
                  ->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_reporte_envio');
    }
}
