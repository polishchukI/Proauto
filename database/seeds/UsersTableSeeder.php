<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
                    'name' => 'Admin',
                    'email' => 'admin@inventory.proauto.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('11111111'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
    }
}
