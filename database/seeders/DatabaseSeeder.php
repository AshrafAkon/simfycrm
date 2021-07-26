<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        //$this->call(ProductsSeeder::class);
        //$this->call(CustomerSeeder::class);
        //$this->call(InvoiceSeeder::class);
        $this->call(CourierSeeder::class);
        //$this->call(ExpenseSeeder::class);
        //$this->call(ExpenseRecordSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(InvoiceStatusSeeder::class);
        $this->call(ModelPermissionSeeder::class);
    }
}
