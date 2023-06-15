<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    // for admin user
                    'name' => 'Admin',
                    'username' => 'admin',
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('12345678'),
                    'email_verified_at' => Carbon::now(),
                    'role' => 'admin',
                    'status' => 'active',
                    'photo' => fake()->imageUrl('60', '60'),
                    'phone' => fake()->phoneNumber(),
                    'address' => fake()->address(),
                    'remember_token' => Str::random(10),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),

                ],
                [
                    // for agent user
                    'name' => 'Agent',
                    'username' => 'agent',
                    'email' => 'agent@agent.com',
                    'password' => Hash::make('12345678'),
                    'email_verified_at' => Carbon::now(),
                    'role' => 'agent',
                    'status' => 'active',
                    'photo' => fake()->imageUrl('60', '60'),
                    'phone' => fake()->phoneNumber(),
                    'address' => fake()->address(),
                    'remember_token' => Str::random(10),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    // for  user
                    'name' => 'User',
                    'username' => 'user',
                    'email' => 'user@user.com',
                    'password' => Hash::make('12345678'),
                    'email_verified_at' => Carbon::now(),
                    'role' => 'user',
                    'status' => 'active',
                    'photo' => fake()->imageUrl('60', '60'),
                    'phone' => fake()->phoneNumber(),
                    'address' => fake()->address(),
                    'remember_token' => Str::random(10),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]
        );
    }
}
