<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenTidakLolosAndTokenLolosToStemmingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stemmings', function (Blueprint $table) {
            $table->text('token_tidak_lolos')->nullable();
            $table->text('token_lolos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stemmings', function (Blueprint $table) {
            $table->dropColumn('token_tidak_lolos');
            $table->dropColumn('token_lolos');
        });
    }
}
