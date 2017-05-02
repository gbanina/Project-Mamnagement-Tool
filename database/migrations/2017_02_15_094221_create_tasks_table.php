<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('internal_id')->unsigned();
            $table->string('name', 45)->nullable();
            $table->text('description')->nullable();
            $table->integer('status_id')->unsigned();
            $table->integer('priority_id')->unsigned();
            $table->integer('task_type_id')->unsigned();
            $table->enum('archived', ['YES', 'NO'])->nullable();
            $table->integer('responsible_id')->unsigned();
            $table->date('estimated_start_date')->nullable();
            $table->date('estimated_end_date')->nullable();
            $table->integer('estimated_cost')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('project_id', 'fk_tasks_projects1_idx')
                ->references('id')->on('projects')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('status_id', 'fk_tasks_status1_idx')
                ->references('id')->on('status')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('priority_id', 'fk_tasks_priority1_idx')
                ->references('id')->on('priority')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('task_type_id', 'fk_tasks_task_types1_idx')
                ->references('id')->on('task_types')
                ->onDelete('no action')
                ->onUpdate('no action');
            /*
            $table->foreign('responsible_id', 'fk_tasks_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });*/
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
