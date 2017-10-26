<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterReportsTableStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->unsignedInteger('status_fk')->nullable();
            $table->foreign('status_fk')->references('id')->on('report_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->string('status');
            $table->dropForeign('status_fk');
            $table->dropColumn('status_fk');
        });
    }
}

