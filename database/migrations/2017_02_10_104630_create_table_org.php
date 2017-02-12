<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->Integer('owner_id')->unsigned();
            $table->Integer('parent_id')->unsigned()->nullable();
            $table->string('name', 45);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('organisations', function($table) {
            $table->foreign('owner_id', 'fk_organisation_owner1_idx')
                ->references('id')->on('owners')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('parent_id', 'fk_organisation_organisation1_idx')
                ->references('id')->on('organisations')
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
       Schema::dropIfExists('organisations');
     }
}
