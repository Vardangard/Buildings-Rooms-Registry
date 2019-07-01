<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePertvarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertvaras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patalpos_id')->unsigned();
            $table->foreign('patalpos_id')->references('id')->on('patalpas')->onDelete('cascade');
            $table->float('kvadratura', 8, 2);
            $table->integer('talpa');
            $table->string('tipas', 30);
            $table->string('nr');
            $table->unique(['nr', 'patalpos_id']);
            $table->date('startdate');
            $table->date('enddate')->nullable();
            $table->string('telefonas', 50)->nullable();
            $table->string('faksas', 50)->nullable();
            $table->string('busena', 30);
            $table->string('atsakingas', 100)->nullable();
            $table->string('multimedia', 50)->nullable();
            $table->string('pc', 50)->nullable();
            $table->string('irmv', 50)->nullable();
            $table->string('stalas', 50)->nullable();
            $table->string('uztamsinimas', 50)->nullable();
            $table->string('garsas', 50)->nullable();
            $table->string('igarsinimas', 50)->nullable();
            $table->string('ekranas', 50)->nullable();
            $table->string('internetas', 50)->nullable();
            $table->string('pavadinimas', 50);
            $table->string('projektinis', 10)->nullable();
            $table->string('kondicionierius', 50)->nullable();
            $table->string('ekr_dydis', 50)->nullable();
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
        Schema::dropIfExists('pertvaras');
    }
}
