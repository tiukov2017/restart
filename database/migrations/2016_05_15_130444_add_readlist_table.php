<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReadlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('title');
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
        Schema::drop('bookmarks');
    }
}
