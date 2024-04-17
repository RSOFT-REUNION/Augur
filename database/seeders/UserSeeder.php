<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Rsoft',
            'email' => 'dev@rsoft.re',
            'password' => Hash::make('password'),
            'active' => 1
        ]);

        User::create([
            'name' => 'Florian',
            'email' => 'florian.duboisgueheneuc@augur.re',
            'password' => Hash::make('123456'),
            'active' => 1
        ]);

        User::create([
            'name' => 'Bruno',
            'email' => 'essentiels.reunion@laposte.net',
            'password' => Hash::make('123456'),
            'active' => 1
        ]);
    }
}
