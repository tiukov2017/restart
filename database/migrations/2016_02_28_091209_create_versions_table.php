<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reports_fk');
            $table->string('url');
            $table->unsignedInteger('user_fk');
            $table->foreign('reports_fk')->references('id')->on('reports');
            $table->foreign('user_fk')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('versions');

    }
}
