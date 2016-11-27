<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LinkUsersUsergroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** @var Builder $schemaBuilder */
        $schemaBuilder = Schema::getFacadeRoot();
        $schemaBuilder->table('users', function (Blueprint $table) {
            $table->unsignedInteger('user_group_id');
            $table->index('user_group_id');
            $table->foreign('user_group_id')->references('id')->on('user_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $schemaBuilder = Schema::getFacadeRoot();
        $schemaBuilder->table('users', function (Blueprint $table) {
            $table->dropForeign(['user_group_id']);
            $table->dropIndex(['user_group_id']);
            $table->dropColumn('user_group_id');
        });
    }
}
