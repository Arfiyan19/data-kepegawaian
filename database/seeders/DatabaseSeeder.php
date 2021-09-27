<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'TestUser',
            'email' => 'testuser@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('testuser'),
            'role' => 'user',
        ]);

        $admin = User::create([
            'name' => 'TestAdmin',
            'email' => 'testadmin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('testadmin'),
            'role' => 'admin',
        ]);
    }
}
