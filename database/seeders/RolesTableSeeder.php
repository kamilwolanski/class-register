<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
        /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dodajemy role do tabeli 'roles'
        Role::create(['name' => 'student']);
        Role::create(['name' => 'teacher']);
    }
}
