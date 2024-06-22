<?php

namespace Database\Seeders;

use App\Models\Rt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rt::create([
            'nama_rt'   => 'RT Test',
            'no_rt'     => '1',
            'alamat_rt'    => 'Jl. ABC',
            'rw_id'     => '1',
        ]);
    }
}
