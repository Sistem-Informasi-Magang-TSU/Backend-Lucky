<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if admin user exists, if not create one
        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'Admin Fakultas',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
            $this->command->info('Admin Fakultas user created successfully.');
        } else {
            $this->command->info('Admin Fakultas user already exists.');
        }

        if (!User::where('email', 'universitas@admin.com')->exists()) {
            User::create([
                'name' => 'Admin Universitas',
                'email' => 'universitas@admin.com',
                'password' => Hash::make('password'),
                'role' => 'admin_universitas',
            ]);
            $this->command->info('Admin Universitas user created successfully.');
        } else {
            $this->command->info('Admin Universitas user already exists.');
        }

        if (!User::where('email', 'informatika@admin.com')->exists()) {
            User::create([
                'name' => 'Admin Informatika',
                'email' => 'informatika@admin.com',
                'password' => Hash::make('password'),
                'role' => 'admin_prodi',
                'prodi' => 'Informatika',
            ]);
            $this->command->info('Admin Prodi Informatika user created successfully.');
        } else {
            $this->command->info('Admin Prodi Informatika user already exists.');
        }
    }
}
