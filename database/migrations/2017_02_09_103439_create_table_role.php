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
            $table->integer('owner_id')->unsigned();
            $table->string('name', 45)->nullable();
            $table->unique(["id"], 'unique_role');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('roles', function($table) {
            $table->foreign('owner_id', 'fk_role_owner_idx')
                ->references('id')->on('owners')
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
       Schema::dropIfExists('role');
     }
}
