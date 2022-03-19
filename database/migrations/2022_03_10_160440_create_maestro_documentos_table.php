<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaestroDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maestro_documentos', function (Blueprint $table) {
            $table->id();
            $table->integer('empresa_id')->nullable();
            $table->string('vigencia')->nullable();
            $table->string('codigo')->nullable();
            $table->integer('seccion')->nullable();
            $table->integer('estandar')->nullable();
            $table->string('nombre')->nullable();
            $table->string('nombre_corto')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('tipo_documento')->nullable();
            $table->string('enlace_modelo')->nullable();
            $table->string('sistema')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('extension')->nullable();
            $table->integer('estado')->nullable();
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
        Schema::dropIfExists('maestro_documentos');
    }
}
