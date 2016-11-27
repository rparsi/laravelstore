<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateProductBundlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_bundles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('title');
            $table->decimal('price');

            $table->unsignedInteger('currency_id');
            $table->index('currency_id');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->timestamps();
        });

        $sql = 'ALTER TABLE `product_bundles` ' .
            'ADD UNIQUE KEY `product_bundles_name_unique` (`name`(100))'
        ;
        /** @var \Illuminate\Database\DatabaseManager $manager */
        $manager = DB::getFacadeRoot();
        $manager->connection()->getPdo()->exec($sql);

        Schema::create('product_bundles_products', function (Blueprint $table) {
            $table->unsignedInteger('product_bundle_id');
            $table->index('product_bundle_id');
            $table->foreign('product_bundle_id')->references('id')->on('product_bundles');

            $table->unsignedInteger('product_id');
            $table->index('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->primary(['product_bundle_id', 'product_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_bundles_products');
        Schema::dropIfExists('product_bundles');
    }
}
