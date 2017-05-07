<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewNewerFieldsToTaskType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_fields', function (Blueprint $table) {
            $table->dropColumn(['type']);
        });

        Schema::table('task_fields', function (Blueprint $table) {
            $table->enum('type', ['NUMBER',
                                  'INPUT',
                                  'TEXTAREA',
                                  'DATE',
                                  'ENUM',
                                  'CHECKBOX',
                                  'USER',
                                  'FILE',
                                  'TYPE',
                                  'NAME',
                                  'DESCRIPTION',
                                  'RESPONSIBLE',
                                  'RESPONSIBLES',
                                  'STATUS',
                                  'PRIORITY',
                                  'ESTIMATED_START_DATE',
                                  'ESTIMATED_END_DATE',
                                  'ESTIMATED_COST',
                                  'COMMENTS',
                                  'WORK'])->nullable()->after('account_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
