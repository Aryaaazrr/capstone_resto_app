<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::enableForeignKeyConstraints();

        $data = [
            'SuperAdmin', 'Admin', 'Customer'
        ];

        foreach ($data as $value) {
            Role::insert([
                'name' => $value
            ]);
        }

        User::factory()->create([
            'username'          => 'superadmin',
            'password'          => Hash::make('superadmin'),
            'id_role'          => 1,
        ]);

        User::factory()->create([
            'username'          => 'admin',
            'password'          => Hash::make('admin'),
            'id_role'          => 2,
        ]);

        User::factory()->create([
            'username'          => 'customer',
            'password'          => Hash::make('customer'),
            'id_role'          => 3,
        ]);

        \App\Models\User::factory(10)->create();
    }
}