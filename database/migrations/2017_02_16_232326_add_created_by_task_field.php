<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedByTaskField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('created_by')->unsigned()->default(1);
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('created_by', 'fk_tasks_users2_idx')
                ->references('id')->on('users')
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
     }
}
