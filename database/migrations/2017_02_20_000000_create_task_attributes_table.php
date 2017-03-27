<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskAttributesTable extends Migration
{
    /**
     * Run the migrations.
     * @table task_attributes
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_attributes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->longText('value')->nullable();
            $table->integer('task_id')->unsigned();
            $table->integer('task_field_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('task_id', 'fk_task_attributes_tasks1_idx')
                ->references('id')->on('tasks')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('task_field_id', 'fk_task_attributes_task_fields1_idx')
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
       Schema::dropIfExists('task_attributes');
     }
}
