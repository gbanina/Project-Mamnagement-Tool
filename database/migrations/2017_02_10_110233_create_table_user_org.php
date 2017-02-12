<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserOrg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_organisations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('organisation_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('user_organisations', function($table) {
            $table->foreign('organisation_id', 'fk_user_organisation_organisation1_idx')
                ->references('id')->on('organisations')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_user_organisation_users1_idx')
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
       Schema::dropIfExists('user_organisations');
     }
}
