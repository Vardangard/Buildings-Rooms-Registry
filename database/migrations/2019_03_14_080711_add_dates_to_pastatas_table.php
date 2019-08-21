<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatesToPastatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('luadm.pp_pastatai', function (Blueprint $table) {
            $table->string('darbo_laikas_p_s', 20)->nullable();
            $table->string('darbo_laikas_p_e', 20)->nullable();
            $table->string('darbo_laikas_ses_s', 20)->nullable();
            $table->string('darbo_laikas_ses_e', 20)->nullable();
            $table->string('darbo_laikas_sek_s', 20)->nullable();
            $table->string('darbo_laikas_sek_e', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('luadm.pp_pastatai', function (Blueprint $table) {
            $table->dropColumn('darbo_laikas_p_s', 20);
            $table->dropColumn('darbo_laikas_p_e', 20);
            $table->dropColumn('darbo_laikas_ses_s', 20);
            $table->dropColumn('darbo_laikas_ses_e', 20);
            $table->dropColumn('darbo_laikas_sek_s', 20);
            $table->dropColumn('darbo_laikas_sek_e', 20);
        });
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    /*public function up()
    {
        Schema::table('pastatas', function (Blueprint $table) {
            $table->string('darbo_laikas_p_s', 20)->nullable();
            $table->string('darbo_laikas_p_e', 20)->nullable();
            $table->string('darbo_laikas_ses_s', 20)->nullable();
            $table->string('darbo_laikas_ses_e', 20)->nullable();
            $table->string('darbo_laikas_sek_s', 20)->nullable();
            $table->string('darbo_laikas_sek_e', 20)->nullable();
        });
    }*/

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    /*public function down()
    {
        Schema::table('pastatas', function (Blueprint $table) {
            $table->dropColumn('darbo_laikas_p_s', 20);
            $table->dropColumn('darbo_laikas_p_e', 20);
            $table->dropColumn('darbo_laikas_ses_s', 20);
            $table->dropColumn('darbo_laikas_ses_e', 20);
            $table->dropColumn('darbo_laikas_sek_s', 20);
            $table->dropColumn('darbo_laikas_sek_e', 20);
        });
    }*/
}
