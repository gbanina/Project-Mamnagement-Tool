<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTypeFieldsTable extends Migration
{
    /**
     * Run the migrations.
     * @table task_type_fields
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_type_fields', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('task_type_id')->unsigned();
            $table->integer('task_fields_id')->unsigned();

            $table->foreign('task_fields_id', 'fk_task_type_fields_task_fields1_idx')
                ->references('id')->on('task_fields')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('task_type_fields');
     }
}
