<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodegasTable extends Migration
{
    public function up()
    {
        Schema::create('bodegas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ubicación');
            $table->foreignId('responsable_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bodegas');
    }
}