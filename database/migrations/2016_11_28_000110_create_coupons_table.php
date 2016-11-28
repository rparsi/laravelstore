<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('code', 100);
            $table->dateTime('valid_from')->nullable();
            $table->dateTime('valid_to')->nullable();
            $table->decimal('discount'); // in percentage, ie 10% off stored as 0.10
            $table->unsignedInteger('times_used')->default(0);
            $table->unsignedInteger('times_used_limit')->default(0);

            $table->timestamps();
        });

        $sql = 'ALTER TABLE `coupons` ' .
            'ADD UNIQUE KEY `coupons_name_unique` (`name`(100)), ' .
            'ADD UNIQUE KEY `coupons_code_unique` (`code`(100))'
        ;
        /** @var \Illuminate\Database\DatabaseManager $manager */
        $manager = DB::getFacadeRoot();
        $manager->connection()->getPdo()->exec($sql);

        Schema::create('coupons_products', function (Blueprint $table) {
            $table->unsignedInteger('coupon_id');
            $table->index('coupon_id');
            $table->foreign('coupon_id')->references('id')->on('coupons');

            $table->unsignedInteger('product_id');
            $table->index('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->primary(['coupon_id', 'product_id']);

            $table->timestamps();
        });

        Schema::create('coupons_product_bundles', function (Blueprint $table) {
            $table->unsignedInteger('coupon_id');
            $table->index('coupon_id');
            $table->foreign('coupon_id')->references('id')->on('coupons');

            $table->unsignedInteger('product_bundle_id');
            $table->index('product_bundle_id');
            $table->foreign('product_bundle_id')->references('id')->on('product_bundles');

            $table->primary(['coupon_id', 'product_bundle_id']);

            $table->timestamps();
        });

        Schema::create('purchase_orders_coupons', function (Blueprint $table) {
            $table->unsignedInteger('purchase_order_id');
            $table->index('purchase_order_id');
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders');

            $table->unsignedInteger('coupon_id');
            $table->index('coupon_id');
            $table->foreign('coupon_id')->references('id')->on('coupons');

            $table->primary(['purchase_order_id', 'coupon_id']);

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
        Schema::dropIfExists('purchase_orders_coupons');
        Schema::dropIfExists('coupons_products');
        Schema::dropIfExists('coupons_product_bundles');
        Schema::dropIfExists('coupons');
    }
}
