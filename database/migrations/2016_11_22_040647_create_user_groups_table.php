<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('slug', 100);
            $table->text('description');
            $table->boolean('is_admin');
            $table->timestamps();
        });

        $sql = 'ALTER TABLE `user_groups` ' .
            'ADD UNIQUE KEY `user_groups_name_unique` (`name`(100)),' .
            'ADD UNIQUE KEY `user_gorups_slug_unique` (`slug`(100))'
        ;
        /** @var \Illuminate\Database\DatabaseManager $manager */
        $manager = DB::getFacadeRoot();
        $manager->connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_groups');
    }
}
