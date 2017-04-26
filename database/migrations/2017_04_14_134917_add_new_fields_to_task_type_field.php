<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToTaskTypeField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_type_fields', function (Blueprint $table) {
            $table->boolean('required')->unsigned()->after('task_field_id');
            $table->integer('index')->unsigned()->after('task_field_id');
            $table->integer('col')->unsigned()->after('task_field_id');
            $table->integer('row')->unsigned()->after('task_field_id');
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
