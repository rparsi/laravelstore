<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // @see https://en.wikipedia.org/wiki/ISO_3166-1#Current_code
        $now = new \DateTime();
        $records = [
            [
                'name' => 'Canada',
                'alpha_2_code' => 'CA',
                'alpha_3_code' => 'CAN',
                'numeric_code' => '124',
                'created_at' => $now->format('Y-m-d')
            ],
            [
                'name' => 'United States of America',
                'alpha_2_code' => 'US',
                'alpha_3_code' => 'USA',
                'numeric_code' => '840',
                'created_at' => $now->format('Y-m-d')
            ]
        ];
        /** @var \Illuminate\Database\DatabaseManager $manager */
        $manager = DB::getFacadeRoot();
        $queryBuilder = $manager->connection()->table('countries');

        foreach ($records as $record) {
            $queryBuilder->insert($record);
        }
    }
}
