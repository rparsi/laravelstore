<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('title');
            $table->decimal('price');

            $table->unsignedInteger('product_type_id');
            $table->index('product_type_id');
            $table->foreign('product_type_id')->references('id')->on('product_types');

            $table->unsignedInteger('currency_id');
            $table->index('currency_id');
            $table->foreign('currency_id')->references('id')->on('currencies');

            $table->timestamps();
        });

        $sql = 'ALTER TABLE `products` ' .
            'ADD UNIQUE KEY `products_name_unique` (`name`(100))'
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
        Schema::dropIfExists('products');
    }
}
