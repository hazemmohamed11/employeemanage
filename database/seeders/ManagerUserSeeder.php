<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class ManagerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::firstOrCreate(['name' => 'manager']);

        $user = User::where('email', 'manager@example.com')->first();

        if (!$user) {
            // Create a manager user
            $user = User::create([
                'name' => 'ManagersUser',
                'email' => 'manager@example.com',
                'password' => Hash::make('secretpassword'),
            ]);

            $user->assignRole($role);

            $this->command->info('Manager user created successfully.');
        } else {
            $this->command->info('Manager user already exists.');
        }
    }
}