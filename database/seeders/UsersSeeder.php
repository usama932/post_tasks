<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $demoUser2 = User::create([
            'name'              => "Admin",
            'email'             => 'admin@admin.com',
            'password'          => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);
    }
}
