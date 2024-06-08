<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Role;
use App\Models\Subcategory;
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
                'name' => $value
            ]);
        }

        User::factory()->create([
            'name'          => 'admin',
            'email'          => 'admin@gmail.com',
            'password'          => Hash::make('admin'),
            'id_role'          => 1,
        ]);

        User::factory()->create([
            'name'          => 'customer',
            'email'          => 'customer@gmail.com',
            'password'          => Hash::make('customer'),
            'id_role'          => 2,
        ]);

        \App\Models\User::factory(10)->create();

        $types = ['Menu Makanan', 'Menu Minuman', 'Menu Paket Raminten', 'Kaos Raminten'];
        foreach ($types as $type) {
            Category::create([
                'name' => $type
            ]);
        }

        $bobotKriteriaData = [
            [1, 'Menu Utama'], [2, 'Juss & Smoothies'], [3, 'Menu Paket Reguler'],
            [1, 'Menu Dessert'], [2, 'Dingin Menyegarkan'], [3, 'Menu Paket Reservasi'],
            [1, 'Menu Lauk'], [2, 'Panas Menghangatkan'],
            [1, 'Menu Snack'], [2, 'Hot & Cold'],
        ];

        foreach ($bobotKriteriaData as $bobot) {
            $id_category = $bobot[0];
            $name = $bobot[1];

            Subcategory::create([
                'id_category' => $id_category,
                'name' => $name,
            ]);
        }
    }
}