<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCheckedColumnToResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('google_results', function(Blueprint $table) {
            $table->boolean('is_checked');
            $table->string('user_comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('google_results', function(Blueprint $table) {
            $table->dropColumn('is_checked');
            $table->dropColumn('user_comments');
        });
    }
}
