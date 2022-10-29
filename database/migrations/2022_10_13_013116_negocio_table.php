<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocio', function (Blueprint $table) {
            $table->bigIncrements('id_Negocio');
            $table->unsignedBigInteger('id_Usuario');
            $table->string('nombre',30);
            $table->string('descrip',100);
            $table->string('ubicacion',50);
            $table->string('imagen_negocio',150)->nullable();
            $table->unsignedBigInteger('telefono')->nullable();
            $table->time('horarioInicio')->default('00:00:00');
            $table->time('horarioCierre')->default('00:00:00');

            $table->boolean('activo')->default(1);//TRUE HASTA QUE LO DESACTIVE EL DUEÑO

            $table->timestamps();
            $table->foreign('id_Usuario')->references('id_Usuario')->on('Usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negocio');
    }
};
