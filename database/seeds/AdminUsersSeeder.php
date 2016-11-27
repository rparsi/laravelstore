<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\UserGroup;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var UserGroup $userGroup */
        $userGroup = UserGroup::where('slug', UserGroup::ADMIN)->first();

        $now = new \DateTime();
        $record = [
            'name' => 'admin',
            'email' => 'rahi.parsi@gmail.com',
            'password' => bcrypt('admin'),
            'remember_token' => 'I-have-no-idea',
            'created_at' => $now->format('Y-m-d'),
            'user_group_id' => $userGroup->id
        ];
        /** @var \Illuminate\Database\DatabaseManager $manager */
        $manager = DB::getFacadeRoot();
        $queryBuilder = $manager->connection()->table('users');

        $queryBuilder->insert($record);
    }
}
