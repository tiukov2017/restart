<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterChecksTableAddQueryColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checks', function (Blueprint $table) {
         $table->unsignedInteger('google_query_fk')->nullable();
            $table->foreign('google_query_fk')->references('id')->on('google_queries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checks', function (Blueprint $table) {
            $table->dropForeign('google_query_fk');
            $table->dropColumn('google_query_fk');

        });
    }
}
