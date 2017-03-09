<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     * @table comments
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            //$table->integer('account_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('entity_id');
            $table->enum('type', ['COMMENT', 'NOTE', 'FILE']);
            $table->enum('entity_type', ['PROJECT', 'TASK', 'BOARD']);
            $table->text('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
/*
            $table->foreign('account_id', 'fk_comments_account1_idx')
                ->references('id')->on('accounts')
                ->onDelete('no action')
                ->onUpdate('no action');
        });*/
            $table->foreign('user_id', 'fk_comments_users1_idx')
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
       Schema::dropIfExists('comments');
     }
}
