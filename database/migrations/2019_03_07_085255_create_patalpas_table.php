<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatalpasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patalpas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pastatai_id')->unsigned();
            $table->foreign('pastatai_id')->references('id')->on('pastatas')->onDelete('cascade');
            $table->integer('aukstas');
            $table->integer('pertvaros');
            $table->string('nr', 50);
            $table->unique(['nr', 'pastatai_id']);
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
        Schema::dropIfExists('patalpas');
    }
}
