<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRole extends Migration
{
     /**
     * Run the migrations.
     * @table role
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->string('name', 45)->nullable();
            $table->unique(["id"], 'unique_roles');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('account_id', 'fk_role_owner_idx')
                ->references('id')->on('accounts')
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
       Schema::dropIfExists('roles');
     }
}
