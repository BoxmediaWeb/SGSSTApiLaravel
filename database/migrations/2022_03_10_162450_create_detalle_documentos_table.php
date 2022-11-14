<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_documentos', function (Blueprint $table) {
            $table->id();
            $table->string('fecha')->nullable();
            $table->integer('maestro_id')->nullable();
            $table->integer('version')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('comentario')->nullable();
            $table->string('usuario')->nullable();
            $table->integer('estado')->nullable();
            $table->string('rev')->nullable();
            $table->string('vigencia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_documentos');
    }
}
