<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'Ahmed Osama',
            'email' => 'hello@ahmedosama-st.com',
            'password' => Hash::make('secret123!@#'),
        ]);

        $user->roles()->attach(Role::findByName('admin'));
    }
}
