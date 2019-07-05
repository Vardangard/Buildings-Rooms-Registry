<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pastatas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kodas', 10)->unique();
            $table->string('adresas', 50);
            $table->string('kadastronr', 30)->unique();
            $table->string('padaliniai', 500)->nullable();
            $table->string('pavadinimas', 150)->unique();
            $table->string('miestas', 15);
            $table->string('busena', 30);
            $table->integer('aukstai');
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
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
        Schema::dropIfExists('pastatas');
    }
}
