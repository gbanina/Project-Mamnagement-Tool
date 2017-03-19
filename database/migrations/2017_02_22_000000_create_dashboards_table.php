<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDashboardsTable extends Migration
{
    /**
     * Run the migrations.
     * @table dashboards
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboards', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->enum('editable', ['Y', 'N']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('account_id', 'fk_dashboards_accounts1_idx')
                ->references('id')->on('accounts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('project_id', 'fk_dashboards_projects1_idx')
                ->references('id')->on('projects')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_dashboards_users1_idx')
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
       Schema::dropIfExists('dashboards');
     }
}
