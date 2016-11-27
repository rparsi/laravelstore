<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('alpha_2_code', 10)->index();
            $table->string('alpha_3_code', 10)->index();
            $table->string('numeric_code', 10)->index();
            $table->timestamps();
        });

        $sql = 'ALTER TABLE `countries` ' .
            'ADD UNIQUE KEY `countries_name_unique` (`name`(100))'
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
        Schema::dropIfExists('countries');
    }
}
