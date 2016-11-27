<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('symbol', 10);
            $table->unsignedInteger('country_id');
            $table->index('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->timestamps();
        });

        $sql = 'ALTER TABLE `currencies` ' .
            'ADD UNIQUE KEY `currencies_name_unique` (`name`(100))'
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
        Schema::dropIfExists('currencies');
    }
}
