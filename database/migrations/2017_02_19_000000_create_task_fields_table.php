<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskFieldsTable extends Migration
{
    /**
     * Run the migrations.
     * @table task_type_attributes
     *
     * @return void
     */
public function up()
    {
        Schema::create('task_fields', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->enum('type', ['NUMBER', 'INPUT', 'TEXTAREA', 'DATE', 'USER', 'FILE'])->nullable();
            $table->string('label', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('account_id', 'fk_task_fields_accounts1_idx')
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
       Schema::dropIfExists('task_fields');
     }}

