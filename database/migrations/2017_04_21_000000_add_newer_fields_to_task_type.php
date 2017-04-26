<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewerFieldsToTaskType extends Migration
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
            $table->boolean('predefined')->unsigned()->after('account_id');
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
                                  'STATUS',
                                  'PRIORITY',
                                  'ESTIMATED_START_DATE',
                                  'ESTIMATED_END_DATE',
                                  'ESTIMATED_COST'])->nullable()->after('account_id');
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
