<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $superadmin = User::create([
            'name' => 'super admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin')
        ]);

        $superadmin->assignRole('super admin');

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user')
        ]);

        $user->assignRole('user');
    }
}
