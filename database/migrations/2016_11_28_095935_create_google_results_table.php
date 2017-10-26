<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoogleResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_results', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('report_fk');
            $table->string('query');
            $table->longText('url');
            $table->longText('title');
            $table->longText('description');
            $table->string('results_summary');
            $table->unsignedInteger('query_fk')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('report_fk')->references('id')->on('reports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('google_results');
    }
}
