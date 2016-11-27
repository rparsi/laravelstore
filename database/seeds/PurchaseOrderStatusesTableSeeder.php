<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseOrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new \DateTime();
        $createdAt = $now->format('Y-m-d');
        $records = [
            [
                'name' => 'Pre-checkout',
                'slug' => 'pre-checkout',
                'description' => 'User is in shopping mode, where items are added/removed/changed from the cart',
                'allow_add_item' => true,
                'allow_edit_item' => true,
                'allow_remove_item' => true
            ],
            [
                'name' => 'Checkout',
                'slug' => 'checkout',
                'description' => 'User finalizes the cart, can still add/remove/change items',
                'allow_add_item' => true,
                'allow_edit_item' => true,
                'allow_remove_item' => true
            ],
            [
                'name' => 'Payment information',
                'slug' => 'payment-info',
                'description' => 'User selects their payment method and provides details (ie credit card info)',
                'allow_add_item' => false,
                'allow_edit_item' => false,
                'allow_remove_item' => false
            ],
            [
                'name' => 'Payment processing',
                'slug' => 'payment-processing',
                'description' => 'Financial transaction is being processed (ie credit card info sent to payment gateway)',
                'allow_add_item' => false,
                'allow_edit_item' => false,
                'allow_remove_item' => false
            ],
            [
                'name' => 'Payment rejected',
                'slug' => 'payment-rejected',
                'description' => 'Financial transaction failed to be processed for some reason (ie credit card rejected)',
                'allow_add_item' => false,
                'allow_edit_item' => false,
                'allow_remove_item' => false
            ],
            [
                'name' => 'Payment confirmed',
                'slug' => 'payment-confirmed',
                'description' => 'Financial transaction went through without issues',
                'allow_add_item' => false,
                'allow_edit_item' => false,
                'allow_remove_item' => false
            ],
            [
                'name' => 'Delivery in progress',
                'slug' => 'delivery',
                'description' => 'Items are being packaged and shipped',
                'allow_add_item' => false,
                'allow_edit_item' => false,
                'allow_remove_item' => false
            ],
            [
                'name' => 'Delivered',
                'slug' => 'deliverd',
                'description' => 'All items delivered',
                'allow_add_item' => false,
                'allow_edit_item' => false,
                'allow_remove_item' => false
            ]
        ];
        /** @var \Illuminate\Database\DatabaseManager $manager */
        $manager = DB::getFacadeRoot();
        $queryBuilder = $manager->connection()->table('purchase_order_statuses');

        foreach ($records as $record) {
            $record['created_at'] = $createdAt;
            $queryBuilder->insert($record);
        }
    }
}
