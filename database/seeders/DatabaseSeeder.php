<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)->create([
            'name' => 'alamsyah',
            'email' => 'alam@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('alamsyah'), // password
            'visible_password' => 'alamsyah', // password
            'occupation' => 'admin',
            'address' => 'Indonesia',
            'is_admin' => 1,
            'remember_token' => Str::random(10),
        ]);
    }
}
