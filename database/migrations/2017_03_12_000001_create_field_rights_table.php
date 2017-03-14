<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldRightsTable extends Migration
{
    /**
     * Run the migrations.
     * @table field_rights
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_rights', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->integer('role_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->integer('task_type_id')->unsigned();
            $table->integer('task_field_id')->unsigned();

            $table->enum('permission', ['NONE', 'READ', 'WRITE']);

            // To long
            //$table->unique(array('role_id', 'project_id', 'task_type_id', 'task_field_id'));
            $table->primary(['role_id', 'project_id','task_type_id', 'task_field_id'] , 'fieldrights1_primary');

            $table->timestamps();

            $table->foreign('role_id', 'fk_field_rights_role2_idx')
                ->references('id')->on('roles')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('project_id', 'fk_field_rights_projects2_idx')
                ->references('id')->on('projects')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('task_type_id', 'fk_field_rights_task_types1_idx')
                ->references('id')->on('task_types')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('task_field_id', 'fk_field_rights_task_fields1_idx')
                ->references('id')->on('task_fields')
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
       Schema::dropIfExists('field_rights');
     }
}
