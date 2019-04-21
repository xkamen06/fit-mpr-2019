<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FileTableMakeIdPhaseNotUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('file', function (Blueprint $table) {
            $table->dropUnique('file_id_phase_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('file', function (Blueprint $table) {
            $table->unique('file_id_phase_unique');
        });
    }
}
