<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeReportTypeColumnOnchecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checks', function (Blueprint $table) {

            $table->dropColumn('report_type');

            $table->unsignedInteger('type_fk')->nullable();

            $table->foreign('type_fk')->references('id')->on('report_types');
        });
    }

    /**
     *
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checks', function (Blueprint $table) {

            $table->string('report_type');

            $table->dropForeign(['type_fk']);

            $table->dropColumn('type_fk');
        });
    }
}
