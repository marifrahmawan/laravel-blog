<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
            'name' => 'M. Arif Rahmawan',
            'username' => 'arifrahmawan',
            'email' => 'marifrahmawan@gmail.com',
            'password' => \Hash::make('password')
        ]);

        $super_admin->assignRole('super-admin');
    }
}
