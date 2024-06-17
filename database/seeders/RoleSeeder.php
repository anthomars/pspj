<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['nama_role' => 'PSPJ Pusat']);
        Role::create(['nama_role' => 'PSPJ Wilayah']);
        Role::create(['nama_role' => 'RW']);
        Role::create(['nama_role' => 'RT']);
        Role::create(['nama_role' => 'Warga']);
    }
}
