<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestrictedDomainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restricted_domains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('domain');
            $table->unsignedInteger('user_fk');
            $table->foreign('user_fk')->references('id')->on('users');
            $table->rememberToken();
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
        Schema::drop('restricted_domains');
    }
}
