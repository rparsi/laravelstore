<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypesTableSeeder extends Seeder
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
                'name' => 'Processors',
                'slug' => 'cpus',
                'description' => 'Desktop pc processors (AMD/Intel)'
            ],
            [
                'name' => 'Video Cards',
                'slug' => 'gpus',
                'description' => 'Video Cards (AMD/nVidia)'
            ],
            [
                'name' => 'Full Tower Cases',
                'slug' => 'tower-cases',
                'description' => 'ATX format tower cases'
            ]
        ];
        /** @var \Illuminate\Database\DatabaseManager $manager */
        $manager = DB::getFacadeRoot();
        $queryBuilder = $manager->connection()->table('product_types');

        foreach ($records as $record) {
            $record['created_at'] = $createdAt;
            $queryBuilder->insert($record);
        }
    }
}
