<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('references', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_url');
            $table->string('reference_url');
            $table->string('header')->nullable();
            $table->string('category')->nullable();
            $table->unsignedInteger('report_fk');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('report_fk')->references('id')->on('reports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('references');
    }
}
