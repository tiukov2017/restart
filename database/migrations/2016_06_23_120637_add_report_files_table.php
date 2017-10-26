<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReportFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('report_fk');
            $table->string('name');
            $table->string('url');
            $table->string('description')->nullable();
            $table->foreign('report_fk')->references('id')->on('reports');
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
        Schema::drop('report_files');
    }
}
