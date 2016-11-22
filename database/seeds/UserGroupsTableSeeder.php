<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new \DateTime();
        $records = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'description' => 'The top level administrator, can do anything with any data',
                'is_admin' => true,
                'created_at' => $now->format('Y-m-d')
            ],
            [
                'name' => 'Site Member',
                'slug' => 'site-member',
                'description' => 'Standard site user, can do anything with only their data',
                'is_admin' => false,
                'created_at' => $now->format('Y-m-d')
            ]
        ];
        /** @var \Illuminate\Database\DatabaseManager $manager */
        $manager = DB::getFacadeRoot();
        $queryBuilder = $manager->connection()->table('user_groups');

        foreach ($records as $record) {
            $queryBuilder->insert($record);
        }
    }
}
