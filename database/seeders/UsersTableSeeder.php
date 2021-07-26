<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'admin@example.com')->first();
        if (!$user) {
            $usr = User::create(
                [
                    'name' => 'Administrator',
                    'email' => 'admin@example.com',
                    //'role'     => 'admin',
                    'password' => Hash::make('password'),

                ]
            );
            $usr->assignRole('Admin');
        }
    }
}
