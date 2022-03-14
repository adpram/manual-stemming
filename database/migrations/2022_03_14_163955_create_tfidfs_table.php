<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTfidfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tfidfs', function (Blueprint $table) {
            $table->id();
            $table->text('artikel1')->nullable();
            $table->text('artikel2')->nullable();
            $table->text('artikel3')->nullable();
            $table->text('artikel4')->nullable();
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
        Schema::dropIfExists('tfidfs');
    }
}
