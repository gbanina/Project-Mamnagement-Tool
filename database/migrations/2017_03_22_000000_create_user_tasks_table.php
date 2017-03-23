<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTasksTable extends Migration
{
    /**
     * Run the migrations.
     * @table user_tasks
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tasks', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->integer('user_id')->unsigned();
            $table->integer('task_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id', 'fk_users_tasks_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('task_id', 'fk_users_tasks_users2_idx')
                ->references('id')->on('tasks')
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
       Schema::dropIfExists('user_tasks');
     }
}
