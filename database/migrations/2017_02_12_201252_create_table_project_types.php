<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProjectTypes extends Migration
{
     /**
     * Run the migrations.
     * @table project_types
     *
     * @return void
     */
      public function up()
    {
         Schema::create('project_types', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->string('label', 45);
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('account_id', 'fk_project_types_owners1_idx')
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
       Schema::dropIfExists('project_types');
     }

}
