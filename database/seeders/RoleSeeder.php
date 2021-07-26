<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = array("Admin", 'Manager', "Executive");
        $view_buying_price = Permission::create(['name' => 'view-buying-price']);
        $delete = Permission::create(["name" => "delete"]);
        $create_product = permission::create(["name" => "create-product"]);
        $admin = Role::create(['name' => "Admin"]);
        $manager = Role::create(['name' => "Manager"]);
        $executive = Role::create(['name' => "Executive"]);

        // giving admin buying price permission

        $admin->givePermissionTo($view_buying_price);
        $admin->givePermissionTo($delete);
        $admin->givePermissionTo($create_product);

        // giving permissions to manager
        $manager->givePermissionTo($create_product);
    }
}
