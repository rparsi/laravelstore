<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug', 100);
            $table->text('description');

            // flags
            $table->boolean('allow_add_item')->default(false);
            $table->boolean('allow_edit_item')->default(false);
            $table->boolean('allow_remove_item')->default(false);

            $table->timestamps();
        });

        $sql = 'ALTER TABLE `purchase_order_statuses` ' .
            'ADD UNIQUE KEY `purchase_order_statuses_name_unique` (`name`(100)),' .
            'ADD UNIQUE KEY `purchase_order_statuses_slug_unique` (`slug`(100))'
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
        Schema::dropIfExists('purchase_order_statuses');
    }
}
