<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExpenseRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ExpenseRecords::class, 10)->create();
    }
}
