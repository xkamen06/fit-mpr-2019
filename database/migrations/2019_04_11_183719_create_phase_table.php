<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phase', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_project');
            $table->bigInteger('id_user');
            $table->bigInteger('id_phase_enum');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->integer('spent_time');
            $table->date('date_from');
            $table->date('date_to');
            $table->string('state');
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
        Schema::dropIfExists('phase');
    }
}
