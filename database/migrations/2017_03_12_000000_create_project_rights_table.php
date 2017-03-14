<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectRightsTable extends Migration
{
    /**
     * Run the migrations.
     * @table project_rights
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_rights', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('role_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->enum('permission', ['NONE', 'READ', 'WRITE', 'DEL']);
            $table->unique(array('role_id', 'project_id'));
            $table->primary(['role_id', 'project_id']);
            $table->timestamps();

            $table->foreign('role_id', 'fk_rights_role1_idx')
                ->references('id')->on('roles')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('project_id', 'fk_project_rights_projects1_idx')
                ->references('id')->on('projects')
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
       Schema::dropIfExists('project_rights');
     }
}


