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
        Role::firstOrCreate(['name' => 'student'], ['name' => 'student']);
        Role::firstOrCreate(['name' => 'teacher'], ['name' => 'teacher']);
        Role::firstOrCreate(['name' => 'admin'], ['name' => 'admin']);
    }
}
