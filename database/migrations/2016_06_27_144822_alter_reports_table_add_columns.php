<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterReportsTableAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->string('mobile_phone')->nullable();
            $table->string('phone')->nullable();
            $table->string('nickname')->nullable();
            $table->string('fax')->nullable();
            $table->string('secondary_name')->nullable();
            $table->string('email')->nullable();
            $table->string('secondary_email')->nullable();
            $table->string('secondary_phone')->nullable();
            $table->string('english_nickname')->nullable();
            $table->string('secondary_english_name')->nullable();

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
            $table->dropColumn('mobile_phone')->nullable();
            $table->dropColumn('phone')->nullable();
            $table->dropColumn('nickname')->nullable();
            $table->dropColumn('fax')->nullable();
            $table->dropColumn('secondary_name')->nullable();
            $table->dropColumn('email')->nullable();
            $table->dropColumn('secondary_email')->nullable();
            $table->dropColumn('secondary_phone')->nullable();
            $table->dropColumn('english_nickname')->nullable();
            $table->dropColumn('secondary_english_name')->nullable();

        });
    }
}
