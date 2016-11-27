<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('purchase_order_status_id');
            $table->index('purchase_order_status_id');
            $table->foreign('purchase_order_status_id')->references('id')->on('purchase_order_statuses');

            $table->decimal('sales_tax'); // as a percentage, ie 10% tax stored as 0.10
            $table->decimal('misc_tax');
            $table->decimal('shipping_fee');
            $table->decimal('misc_fee');

            $table->timestamps();
        });

        Schema::create('purchase_order_logs', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('purchase_order_id');
            $table->index('purchase_order_id');
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders');

            $table->string('purchase_order_status');
            $table->text('message');
            $table->text('details');

            $table->timestamps();
        });

        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('purchase_order_id');
            $table->index('purchase_order_id');
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders');

            $table->unsignedInteger('product_id')->nullable();
            $table->index('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->unsignedInteger('product_bundle_id')->nullable();
            $table->index('product_bundle_id');
            $table->foreign('product_bundle_id')->references('id')->on('product_bundles');

            $table->unsignedInteger('quantity')->default(0);

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
        Schema::dropIfExists('purchase_order_logs');
        Schema::dropIfExists('purchase_order_items');
        Schema::dropIfExists('purchase_orders');
    }
}
