<?php

use App\InvoiceStatus;

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InvoiceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = array(
            'Draft',
            'Confirmed',
            'Invoiced',
            'Packing',
            'Shipped',
            'Delivered',
            'Returned',
            'Cancelled'
        );

        //creating the status entry
        foreach ($statuses as $status) {
            InvoiceStatus::create(['status' => $status]);
        }
        // for ($i = 0; $i < count($statuses); $i++) {
        //     InvoiceStatus::create(['status' => $statuses[$i]]);
        // }
    }
}
