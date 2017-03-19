<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMorphingsTable extends Migration
{
    /**
     * Run the migrations.
     * @table morphings
     *
     * @return void
     */
    public function up()
    {
        Schema::create('morphings', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('user_account_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->enum('type', ['OWNER', 'ADMIN', 'MEMBER']);

            $table->foreign('user_account_id', 'fk_morphings_user_account1_idx')
                ->references('id')->on('user_accounts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('role_id', 'fk_morphings_roles1_idx')
                ->references('id')->on('roles')
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
       Schema::dropIfExists('morphings');
     }
}
