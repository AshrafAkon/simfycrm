<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Courier::class, 1)->create();
    }
}
