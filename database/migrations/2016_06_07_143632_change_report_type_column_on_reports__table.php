<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeReportTypeColumnOnReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {

            $table->unsignedInteger('type_fk')->nullable();

            $table->foreign('type_fk')->references('id')->on('report_types');

            $table->dropColumn('type');
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

            $table->string('type');

            $table->dropForeign(['type_fk']);

            $table->dropColumn('type_fk');
        });
    }
}
