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
            'Admin', 'Customer'
        ];

        foreach ($data as $value) {
            Role::insert([
                'nama_role' => $value
            ]);
        }

        User::factory()->create([
            'name'          => 'admin',
            'email'          => 'admin@admin.com',
            'email_verified_at'          => now(),
            'password'          => Hash::make('admin'),
            'id_role'          => 1,
        ]);

        User::factory()->create([
            'name'          => 'customer',
            'email'          => 'customer@customer.com',
            'email_verified_at'          => now(),
            'password'          => Hash::make('customer'),
            'id_role'          => 2,
        ]);

        \App\Models\User::factory(10)->create();
    }
}
