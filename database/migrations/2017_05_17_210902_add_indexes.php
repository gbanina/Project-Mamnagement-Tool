<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('status', function (Blueprint $table) {
            $table->integer('index')->after('id')->default('0');
        });
        Schema::table('priorities', function (Blueprint $table) {
            $table->integer('index')->after('id')->default('0');
        });
        Schema::table('task_types', function (Blueprint $table) {
            $table->integer('index')->after('id')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
