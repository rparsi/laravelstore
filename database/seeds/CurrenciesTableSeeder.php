<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Country;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $canada = Country::where('alpha_3_code', Country::ALPHA3_CODE_CANADA)->first();
        $usa = Country::where('alpha_3_code', Country::ALPHA3_CODE_USA)->first();

        $now = new \DateTime();
        $records = [
            [
                'name' => 'CAD',
                'symbol' => '$',
                'country_id' => $canada->id,
                'created_at' => $now->format('Y-m-d')
            ],
            [
                'name' => 'USD',
                'symbol' => '$',
                'country_id' => $usa->id,
                'created_at' => $now->format('Y-m-d')
            ]
        ];
        /** @var \Illuminate\Database\DatabaseManager $manager */
        $manager = DB::getFacadeRoot();
        $queryBuilder = $manager->connection()->table('currencies');

        foreach ($records as $record) {
            $queryBuilder->insert($record);
        }
    }
}
