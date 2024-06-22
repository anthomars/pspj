<?php

namespace Database\Seeders;

use App\Models\Rw;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rw::create([
            'nama_rw'   => 'RW Test',
            'no_rw'     => '1',
            'alamat_rw'    => 'Jl. XYZ',
        ]);
    }
}
